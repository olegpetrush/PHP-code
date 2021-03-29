<?php

namespace App\Console\Commands;

use App\Models\Contact;
use App\Models\Ingredient;
use App\Models\Nutrient;
use App\Models\Product;
use App\Models\Statement;
use App\Services\ConsoleColor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HealthJsonProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'health:json:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import JSON files from local directory into DB.';

    protected $console = null;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ConsoleColor $console)
    {
        ini_set('memory_limit','256M');
        $this->console = $console;
        $this->info('Delete statements...');
        Statement::query()->delete();
        $this->info('Delete ingredients...');
        Ingredient::query()->delete();
        $this->info('Delete contacts...');
        Contact::query()->delete();

        $nutrient_names = Nutrient::query()->get(['id', 'name'])
            ->makeHidden(['view_url', 'update_url', 'delete_url'])->toArray();
        $nutrient_other_names_raw = Nutrient::query()->get(['id', 'other_name'])
            ->toArray();
        $nutrient_other_names = [];
        foreach (
            $nutrient_other_names_raw as $index => $nutrient_other_name_raw
        ) {
            if (empty($nutrient_other_name_raw['other_name'])) {
                continue;
            }
            $names = array_map('trim',
                explode(',', trim($nutrient_other_name_raw['other_name'])));
            foreach ($names as $name) {
                $nutrient_other_names[] = [
                    'id'   => $nutrient_other_name_raw['id'],
                    'name' => $name
                ];
            }
        }
        $this->info('Check files...');
        $dir = new \DirectoryIterator(Storage::disk('local')->path('dsldjson'));
        foreach ($dir as $index => $fileinfo) {
            try {
                if ($fileinfo->isDot()) {
                    continue;
                }
                if ($index % 100 === 0) {
                    $this->info('#'.$index.' Process: '
                        .$fileinfo->getFilename());
                }
                $filename = 'dsldjson/'.$fileinfo->getFilename();
                $data = Storage::disk('local')->get($filename);
                $data = mb_convert_encoding($data, 'UTF-8', 'UTF-8');
                $json = json_decode($data, false, 512);
                if (json_last_error()) {
                    var_dump($data);
                    dd(json_last_error_msg());
                }
                if (empty($json->DSLD_ID)) {
                    //throw new \Exception('DSLD_ID is not found. Skip.');
                    continue;
                }
                /** @var Product $product */
                $product = Product::query()->findOrNew((int) $json->DSLD_ID);
                $product->id = (int) $json->DSLD_ID;
                $product->outer_packaging = $json->Outer_Packaging;
                $product->statement_of_identity = $json->Statement_of_Identity;
                $product->langual_dietary_claim_or_use
                    = $json->LanguaL_Dietary_Claim_or_Use;
                $product->count = $json->count;
                $product->product_name = $json->Product_Name;
                $product->langual_product_type = $json->LanguaL_Product_Type;
                $product->brand = $json->Brand;
                $product->date_entered_into_dsld
                    = $json->Date_Entered_into_DSLD;
                $product->serving_size = $json->Serving_Size;
                $product->nhanes_id = $json->NHANES_ID;
                $product->success = $json->success;
                $product->suggested_use = $json->Suggested_Use;
                $product->database = $json->Database;
                $product->net_contents_quantity = $json->Net_Contents_Quantity;
                $product->langual_supplement_form
                    = $json->LanguaL_Supplement_Form;
                $product->product_trademark_copyright_symbol
                    = $json->Product_Trademark_Copyright_Symbol;
                $product->sku = $json->SKU;
                $product->db_source = $json->DB_Source;
                $product->langual_intended_target_groups
                    = $json->LanguaL_Intended_Target_Groups;
                $product->tracking_history = $json->Tracking_History;
                $product->save();
                //$this->info('Product '.$product->id.' has been saved.');

                if ( ! empty($json->statements)) {
                    $precautions = [];
                    $directions = [];
                    $formulations = [];
                    $description = [];
                    foreach ($json->statements as $json_statement) {
                        $statement = new Statement();
                        $statement->product_id = $product->id;
                        $statement->statement = $json_statement->Statement;
                        $statement->statement_type
                            = $json_statement->Statement_Type;
                        $statement->save();
                        if (Str::lower($statement->statement_type)
                            === 'precautions'
                        ) {
                            $precautions[] = $statement->statement;
                        } elseif (Str::lower($statement->statement_type)
                            === 'suggested/recommended/usage/directions'
                        ) {
                            $directions[] = $statement->statement;
                        } elseif (Str::lower($statement->statement_type)
                            === 'formulation'
                        ) {
                            $formulations[] = $statement->statement;
                        } elseif (Str::lower($statement->statement_type)
                            === 'other'
                            && str_word_count($statement->statement) >= 5
                        ) {
                            $description[] = $statement->statement;
                        }
                        //$this->info('Statement: '.$statement->statement_type.' has been saved.');
                    }
                    $product->precautions = ! empty($precautions)
                        ? implode("\n", $precautions) : null;
                    $product->directions = ! empty($directions) ? implode("\n",
                        $directions) : null;
                    $product->formulations = ! empty($formulations)
                        ? implode("\n", $formulations) : null;
                    $product->description = ! empty($description)
                        ? implode("\n", $description) : null;

                    $attributes
                        = $this->parseFormulation($product->formulations);
                    foreach ($attributes as $attribute => $value) {
                        $product->{$attribute} = $value;
                    }
                } else {
                    $product->precautions = null;
                    $product->directions = null;
                    $product->formulations = null;
                    $product->description = null;
                }
                if ($product->isDirty()) {
                    $this->info('Product changed. Apply changes.');
                    $product->save();
                }
                //dd('OK');
                if ( ! empty($json->ingredients)) {
                    foreach ($json->ingredients as $json_ingredient) {
                        /** @var Ingredient $ingredient */
                        $ingredient_id = (int) $json_ingredient->Ingredient_ID;

                        $ingredient = Ingredient::findOrNew($ingredient_id,
                            'ingredient_id');
                        $ingredient->ingredient_id = $ingredient_id;
                        $ingredient->product_id = $product->id;
                        $ingredient->dsld_ingredient_categories
                            = $json_ingredient->DSLD_Ingredient_Categories;
                        $ingredient->amount_serving_unit
                            = $json_ingredient->Amount_Serving_Unit;
                        $ingredient->ingredient_group_grp_id
                            = ! empty($json_ingredient->Ingredient_Group_GRP_ID)
                            ? (int) $json_ingredient->Ingredient_Group_GRP_ID
                            : null;
                        $ingredient->blends
                            = $json_ingredient->{'Blends\'_Ancestry'};
                        $ingredient->amount_per_serving
                            = $json_ingredient->Amount_Per_Serving;
                        $ingredient->dietary_ingredient_synonym_source
                            = $json_ingredient->Dietary_Ingredient_Synonym_Source;
                        if ( ! empty($ingredient->dietary_ingredient_synonym_source)) {
                            // match nutrient_id
                            $nutrient_id = null;
                            foreach ($nutrient_names as $nutrient_name) {
                                if (Str::startsWith($ingredient->dietary_ingredient_synonym_source,
                                    $nutrient_name['name'])
                                ) {
                                    $nutrient_id = $nutrient_name['id'];
                                    break;
                                }
                            }
                            if (empty($nutrient_id)) {
                                foreach ($nutrient_other_names as $other_name) {
                                    if (Str::startsWith($ingredient->dietary_ingredient_synonym_source,
                                        $other_name['name'])
                                    ) {
                                        $nutrient_id = $other_name['id'];
                                        break;
                                    }
                                }
                            }
                            $ingredient->nutrient_id = $nutrient_id;
                        }

                        $ingredient->blended_ingredient_types
                            = $json_ingredient->Blended_Ingredient_Types;
                        $ingredient->pct_daily_value_per_serving
                            = $json_ingredient->Pct_Daily_Value_per_Serving;
                        $ingredient->serving_size
                            = $json_ingredient->Serving_Size;
                        if ( ! empty($ingredient->serving_size)
                            && preg_match('#^([0-9,\.]+?)#siuU',
                                $ingredient->serving_size, $serving_size_value)
                        ) {
                            $ingredient->serving_size_value
                                = floatval(trim(str_replace(',', '.',
                                $serving_size_value[1])));
                        }
                        $ingredient->suggested_recommended_usage_directions
                            = $json_ingredient->{'Suggested_Recommended_Usage_Directions:'};
                        $ingredient->db_source = $json_ingredient->DB_Source;
                        $ingredient->ancestry_number_of_parents_row_ids
                            = $json_ingredient->Ancestry__Number_of_Parents_Row_IDs;
                        $ingredient->save();
                        //$this->info('Ingredient #'.$ingredient->ingredient_id.' has been saved as ID: '.$ingredient->id);
                    }
                }

                if ( ! empty($json->contacts)) {
                    foreach ($json->contacts as $json_contact) {
                        $contact = new Contact();
                        $contact->product_id = $product->id;
                        $contact->zip = $json_contact->ZIP;
                        $contact->is_manufacturer
                            = $json_contact->IS_MANUFACTURER;
                        $contact->type = $json_contact->Type;
                        $contact->is_packager = $json_contact->IS_PACKAGER;
                        $contact->address = $json_contact->Address;
                        $contact->state = $json_contact->State;
                        $contact->is_distributor
                            = $json_contact->IS_DISTRIBUTOR;
                        $contact->city = $json_contact->City;
                        $contact->is_reseller = $json_contact->IS_RESELLER;
                        $contact->is_other = $json_contact->IS_OTHER;
                        $contact->name = $json_contact->Name;
                        $contact->save();
                        //$this->info('Contact: '.$contact->id.' has been saved.');
                    }
                }
            } catch (\Exception $e) {
                $this->error($e->getMessage());
                dd($json);
            }
        }
        return 0;
    }

    protected function parseFormulation(?string $formulation): array
    {
        $attributes = [
            'artificial_flavor' => [
                'value' => true,
                'name'  => 'artificial flavor',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false, // value on regex match
                    ],
                    [
                        'regex'   => '#no .+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'artificial_color'  => [
                'value' => true,
                'name'  => 'artificial color',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false, // value on regex match
                    ],
                    [
                        'regex'   => '#no artificial flavor or color#siUu',
                        'value'   => false, // value on regex match
                    ],
                    [
                        'regex'   => '#no .+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'sweetener'         => [
                'value' => true,
                'name'  => 'sweetener',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#no .+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'preservatives'     => [
                'value' => true,
                'name'  => 'preservatives',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'sugar'             => [
                'value' => true,
                'name'  => 'sugar',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'starch'            => [
                'value' => true,
                'name'  => 'starch',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'milk'              => [
                'value' => true,
                'name'  => 'milk',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'lactose'           => [
                'value' => true,
                'name'  => 'lactose',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'yeast'             => [
                'value' => true,
                'name'  => 'yeast',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'fish'              => [
                'value' => true,
                'name'  => 'fish',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'sodium'            => [
                'value' => true,
                'name'  => 'sodium',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'soy'               => [
                'value' => true,
                'name'  => 'soy',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'gluten'            => [
                'value' => true,
                'name'  => 'gluten',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'wheat'             => [
                'value' => true,
                'name'  => 'wheat',
                'rules' => [
                    [
                        'regex'   => '#no :name#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                ]
            ],
            'vegan'             => [
                'value' => false,
                'name'  => 'vegan',
                'rules' => [
                    [
                        'regex'   => '#:name#siUu',
                        'value'   => true,
                    ],
                ]
            ],
            'vegetarian'        => [
                'value' => false,
                'name'  => 'vegetarian',
                'rules' => [
                    [
                        'regex'   => '#:name#siUu',
                        'value'   => true,
                    ],
                ]
            ],
        ];

        if ( ! empty($formulation)) {
            // parsing.
            foreach ($attributes as $attribute => $parameters) {
                if ( ! empty($parameters['rules'])) {
                    foreach ($parameters['rules'] as $rule) {
                        $rule['regex'] = str_replace(':name', $parameters['name'],
                            $rule['regex']);
                        if(preg_match($rule['regex'],
                            $formulation)){
                            $attributes[$attribute]['value'] = $rule['value'];
                            // first rules applied. break.
                            break;
                        }
                    }
                }
            }
        }

        $response = [];
        foreach ($attributes as $attribute => $value) {
            $response[$attribute] = $value['value'];
        }

        //dump($formulation);
        //dump($response);
        return $response;
    }
}

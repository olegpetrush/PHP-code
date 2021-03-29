<?php

if ( ! function_exists('parse_formulation')) {
    function parse_formulation(?string $formulation): array
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
                        'regex'   => '#no flavor#siUu',
                        'value'   => false, // value on regex match
                    ],
                    [
                        'regex'   => '#no .+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#no .+flavor[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#Does not contain.+flavor[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+:name[^.]+?#siUu',
                        'value'   => false,
                    ],
                    [
                        'regex'   => '#contains no.+flavor[^.]+?#siUu',
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
                    [
                        'regex'   => '#:name free#siUu',
                        'value'   => false,
                    ],
                    [
                        //'regex' => '#:name[^.] free#siUu',
						'regex'	  => '#:name[^.].+?(?=free)free#siUu',
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

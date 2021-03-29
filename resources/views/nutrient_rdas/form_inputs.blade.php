<div class="form-group row">
    <label class="col-4 col-form-label">Nutrient</label>
    <div class="col-8">
        <select name="nutrient_id"
                aria-label="Nutrient"
                class="form-control @error('nutrient_id') is-invalid @enderror"
        >
            <option value="">Choose Nutrient</option>
            @foreach($nutrients as $nutrient)
                <option value="{{$nutrient->id}}"
                        @if(!empty($nutrient_rda) && $nutrient->id===$nutrient_rda->nutrient_id) selected @endif>{{$nutrient->name}}</option>
            @endforeach
        </select>
        @error('nutrient_id')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label">Pregnant</label>
    <div class="col-8">
        <div class="custom-control custom-switch">
            <input type="checkbox" name="pregnant"
                   class="custom-control-input @error('pregnant') is-invalid @enderror"
                   id="nutrient_rdas_pregnant_checkbox"
                   value="1"
                {{old('pregnant',!empty($nutrient_rda)?$nutrient_rda->pregnant:0)?'checked':''}}
            >
            <label class="custom-control-label" for="nutrient_rdas_pregnant_checkbox"></label>
        </div>
        @error('pregnant')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label">Breast Feeding</label>
    <div class="col-8">
        <div class="custom-control custom-switch">
            <input type="checkbox" name="breast_feeding"
                   class="custom-control-input @error('pregnant') is-invalid @enderror"
                   id="nutrient_rdas_breast_feeding_checkbox"
                   value="1"
                {{old('breast_feeding',!empty($nutrient_rda)?$nutrient_rda->breast_feeding:0)?'checked':''}}
            >
            <label class="custom-control-label" for="nutrient_rdas_breast_feeding_checkbox"></label>
        </div>
    </div>
    @error('breast_feeding')
    <div class="invalid-feedback">{{$message}}</div>
    @enderror
</div>

<div class="form-group row">
    <label class="col-4 col-form-label">Age Low</label>
    <div class="col-8">
        <input aria-label="Age Low"
               type="number"
               class="form-control @error('age_low') is-invalid @enderror"
               name="age_low"
               step="0.01"
               value="{{old('age_low',!empty($nutrient_rda)?$nutrient_rda->age_low:'')}}"
               required
        >
        @error('age_low')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label">Age High</label>
    <div class="col-8">
        <input aria-label="Age High"
               type="number"
               class="form-control @error('age_high') is-invalid @enderror"
               name="age_high"
               step="0.01"
               value="{{old('age_high',!empty($nutrient_rda)?$nutrient_rda->age_high:'')}}"
               required
        >
        @error('age_high')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label">Ra Men</label>
    <div class="col-8">
        <input aria-label="Ra Men"
               type="number"
               step="0.01"
               class="form-control @error('ra_men') is-invalid @enderror"
               name="ra_men"
               value="{{old('ra_men',!empty($nutrient_rda)?$nutrient_rda->ra_men:'')}}"
               required
        >
        @error('ra_men')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label">Ra Women</label>
    <div class="col-8">
        <input aria-label="Ra Women"
               type="number"
               step="0.01"
               class="form-control @error('ra_women') is-invalid @enderror"
               name="ra_women"
               value="{{old('ra_women',!empty($nutrient_rda)?$nutrient_rda->ra_women:'')}}"
               required
        >
        @error('ra_women')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label">Ra Unit</label>
    <div class="col-8">
        <select name="ra_unit"
                aria-label="Ra Unit"
                class="form-control @error('ra_unit') is-invalid @enderror"
        >
            @foreach(['mg','mcg','g','IU'] as $ra_unit)
                <option value="{{$ra_unit}}"
                        @if(!empty($nutrient_rda) && $ra_unit===$nutrient_rda->ra_unit) selected @endif>{{$ra_unit}}</option>
            @endforeach
        </select>
        @error('ra_unit')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

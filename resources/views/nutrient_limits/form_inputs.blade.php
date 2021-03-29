<div class="form-group row">
    <label class="col-4 col-form-label">Nutrient</label>
    <div class="col-8">
        <select name="nutrient_id"
                aria-label="Nutrient"
                class="form-control @error('nutrient_id') is-invalid @enderror"
        >
            <option value="">Choose Nutrient</option>
            @foreach($nutrients as $nutrient)
                <option value="{{$nutrient->id}}" @if(!empty($nutrient_limit) && $nutrient->id===$nutrient_limit->nutrient_id) selected @endif>{{$nutrient->name}}</option>
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
                   id="nutrient_limits_pregnant_checkbox"
                   value="1"
                {{old('pregnant',!empty($nutrient_limit)?$nutrient_limit->pregnant:0)?'checked':''}}
            >
            <label class="custom-control-label" for="nutrient_limits_pregnant_checkbox"></label>
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
                   class="custom-control-input @error('breast_feeding') is-invalid @enderror"
                   id="nutrient_limits_breast_feeding_checkbox"
                   value="1"
                {{old('breast_feeding',!empty($nutrient_limit)?$nutrient_limit->breast_feeding:0)?'checked':''}}
            >
            <label class="custom-control-label" for="nutrient_limits_breast_feeding_checkbox"></label>
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
               step="0.01"
               class="form-control @error('age_low') is-invalid @enderror"
               name="age_low"
               value="{{old('age_low',!empty($nutrient_limit)?$nutrient_limit->age_low:'')}}"
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
               value="{{old('age_high',!empty($nutrient_limit)?$nutrient_limit->age_high:'')}}"
               required
        >
        @error('age_high')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label">Upper Limit Men</label>
    <div class="col-8">
        <input aria-label="Upper Limit Men"
               type="number"
               step="0.01"
               class="form-control @error('upper_limit_men') is-invalid @enderror"
               name="upper_limit_men"
               value="{{old('upper_limit_men',!empty($nutrient_limit)?$nutrient_limit->upper_limit_men:'')}}"
               required
        >
        @error('upper_limit_men')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label">Upper Limit Women</label>
    <div class="col-8">
        <input aria-label="Upper Limit Women"
               type="number"
               step="0.01"
               class="form-control @error('upper_limit_women') is-invalid @enderror"
               name="upper_limit_women"
               value="{{old('upper_limit_women',!empty($nutrient_limit)?$nutrient_limit->upper_limit_women:'')}}"
               required
        >
        @error('upper_limit_women')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label">Upper Limit Unit</label>
    <div class="col-8">
        <select name="upper_limit_unit"
                aria-label="Upper Limit Unit"
                class="form-control @error('upper_limit_unit') is-invalid @enderror"
        >
            @foreach(['mg','mcg','g','IU'] as $upper_limit_unit)
                <option value="{{$upper_limit_unit}}" @if(!empty($nutrient_limit) && $upper_limit_unit===$nutrient_limit->upper_limit_unit) selected @endif>{{$upper_limit_unit}}</option>
            @endforeach
        </select>
        @error('upper_limit_unit')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

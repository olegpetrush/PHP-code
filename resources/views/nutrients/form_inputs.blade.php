<div class="form-group row">
    <label class="col-4 col-form-label">Name</label>
    <div class="col-8">
        <input aria-label="Name"
               type="text"
               class="form-control @error('name') is-invalid @enderror"
               name="name"
               value="{{old('name',!empty($nutrient)?$nutrient->name:'')}}"
               required
               maxlength="64"
        >
        @error('name')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label">Other Name</label>
    <div class="col-8">
        <input aria-label="Other Name"
               type="text"
               class="form-control @error('other_name') is-invalid @enderror"
               name="other_name"
               value="{{old('other_name',!empty($nutrient)?$nutrient->other_name:'')}}"
               maxlength="128"
        >
        @error('other_name')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label">Type</label>
    <div class="col-8">
        <input aria-label="Type"
               type="text"
               class="form-control @error('type') is-invalid @enderror"
               name="type"
               value="{{old('type',!empty($nutrient)?$nutrient->type:'')}}"
               required
               maxlength="16"
        >
        @error('type')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label">Daily Value Men</label>
    <div class="col-8">
        <input aria-label="Daily Value Men"
               type="number"
               step="0.01"
               class="form-control @error('daily_value_men') is-invalid @enderror"
               name="daily_value_men"
               value="{{old('daily_value_men',!empty($nutrient)?$nutrient->daily_value_men:'')}}"
               required
        >
        @error('daily_value_men')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label">Daily Value Women</label>
    <div class="col-8">
        <input aria-label="Daily Value Women"
               type="number"
               step="0.01"
               class="form-control @error('daily_value_women') is-invalid @enderror"
               name="daily_value_women"
               value="{{old('daily_value_women',!empty($nutrient)?$nutrient->daily_value_women:'')}}"
               required
        >
        @error('daily_value_women')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label">Upper Limit</label>
    <div class="col-8">
        <input aria-label="Upper Limit"
               type="number"
               step="0.01"
               class="form-control @error('upper_limit') is-invalid @enderror"
               name="upper_limit"
               value="{{old('upper_limit',!empty($nutrient)?$nutrient->upper_limit:0)}}"
               required
        >
        @error('upper_limit')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label">Daily Value Unit</label>
    <div class="col-8">
        <select name="daily_value_unit"
                aria-label="Daily Value Unit"
                class="form-control @error('daily_value_unit') is-invalid @enderror"
        >
            @foreach(['mg','mcg','g','IU'] as $daily_value_unit)
                <option value="{{$daily_value_unit}}"
                        @if(!empty($nutrient) && $daily_value_unit===$nutrient->daily_value_unit) selected @endif>{{$daily_value_unit}}</option>
            @endforeach
        </select>
        @error('daily_value_unit')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label">Primary Sources</label>
    <div class="col-8">
        <textarea aria-label="Primary Sources"
                  name="primary_sources"
                  class="form-control @error('primary_sources') is-invalid @enderror"
                  required
                  rows="5"
        >{{old('primary_sources',!empty($nutrient)?$nutrient->primary_sources:'')}}</textarea>
        @error('primary_sources')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label">Secondary Sources</label>
    <div class="col-8">
        <textarea aria-label="Secondary Sources"
                  name="secondary_sources"
                  class="form-control @error('secondary_sources') is-invalid @enderror"
                  rows="5"
        >{{old('secondary_sources',!empty($nutrient)?$nutrient->secondary_sources:'')}}</textarea>
        @error('secondary_sources')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label">Benefits</label>
    <div class="col-8">
        <textarea aria-label="Benefits"
                  rows="5"
                  name="benefits"
                  class="form-control @error('benefits') is-invalid @enderror"
                  required
        >{{old('benefits',!empty($nutrient)?$nutrient->benefits:'')}}</textarea>
        @error('benefits')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label">Side Effects</label>
    <div class="col-8">
        <textarea aria-label="Side Effects"
                  rows="5"
                  name="side_effects"
                  class="form-control @error('side_effects') is-invalid @enderror"
        >{{old('side_effects',!empty($nutrient)?$nutrient->side_effects:'')}}</textarea>
        @error('side_effects')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label">Interactions</label>
    <div class="col-8">
        <textarea aria-label="Interactions"
                  rows="5"
                  name="interactions"
                  class="form-control @error('interactions') is-invalid @enderror"
        >{{old('interactions',!empty($nutrient)?$nutrient->interactions:'')}}</textarea>
        @error('interactions')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-4 col-form-label">Risks</label>
    <div class="col-8">
        <textarea aria-label="Risks"
                  rows="5"
                  name="risks"
                  class="form-control @error('risks') is-invalid @enderror"
        >{{old('risks',!empty($nutrient)?$nutrient->risks:'')}}</textarea>
        @error('risks')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-4 col-form-label">Notes</label>
    <div class="col-8">
        <textarea aria-label="Notes"
                  rows="5"
                  name="notes"
                  class="form-control @error('notes') is-invalid @enderror"
                  required
        >{{old('notes',!empty($nutrient)?$nutrient->notes:'')}}</textarea>
        @error('notes')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

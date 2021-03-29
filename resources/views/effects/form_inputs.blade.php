<div class="form-group row">
    <label class="col-4 col-form-label">Name</label>
    <div class="col-8">
        <input aria-label="Name"
               type="text"
               class="form-control @error('name') is-invalid @enderror"
               name="name"
               value="{{old('name',!empty($effect)?$effect->name:'')}}"
               required>
        @error('name')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
    </div>
</div>

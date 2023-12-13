<div class="row form-group">

    <label for="teacher" class="col-sm-2 col-form-label">اختر المدرس</label>
    <div class="col-sm-4">
        <select class="form-control pt-0" id="teacher" name="teacher">
            <option selected disabled>اختر اسم المدرس</option>
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}" {{ $teacher->id == old('teacher') ? 'selected' : '' }}>
                    {{ $teacher->name }} - مدرس {{ $teacher->subject->name }}</option>
            @endforeach
        </select>
    </div>
    <label for="date" class="col-sm-2 col-form-label">اختر الشهر والسنة</label>
    <div class="col-sm-4">
        <input type="month" class="form-control" id="date" name="date" value="{{ old('date') }}">
    </div>
</div>
@if ($errors->any())
    <div class="row">
        <div class="col-sm-2  message pl-3 pr-3 mt-1 ">
        </div>
        <div class="col-sm-4  message pl-3 pr-3 mt-1 ">
            @if ($errors->has('teacher'))
                <div class="text-light text-center bg-secondary pt-2 pb-2">
                    {{ $errors->first('teacher') }}</div>
            @endif
        </div>
        <div class="col-sm-2  message pl-3 pr-3 mt-1 ">
        </div>
        <div class="col-sm-4  message pl-3 pr-3 mt-1 ">
            @if ($errors->has('date'))
                <div class="text-light text-center bg-secondary pt-2 pb-2">
                    {{ $errors->first('date') }}</div>
            @endif
        </div>



    </div>
@endif
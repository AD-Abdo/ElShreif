<div class="row form-group">

    <label for="teacher" class="col-sm-1 col-form-label">اختر المدرس</label>
    <div class="col-sm-11">
        <select class="form-control pt-0" id="teacher" name="teacher">
            <option selected disabled>اختر اسم المدرس</option>
            @foreach ($teachers as $teacher)
                <option value="{{ $teacher->id }}" {{ $teacher->id == old('teacher') ? 'selected' : '' }}>
                    {{ $teacher->name }} - مدرس {{ $teacher->subject->name }}</option>
            @endforeach
        </select>
    </div>
</div>
@if ($errors->any())
    <div class="row mb-3">
        <div class="col-md-1  message pl-3 pr-3 mt-1 ">
        </div>
        <div class="col-md-11  message pl-3 pr-3 mt-1 ">
            @if ($errors->has('teacher'))
                <div class="text-light text-center bg-secondary pt-2 pb-2">
                    {{ $errors->first('teacher') }}</div>
            @endif
        </div>



    </div>
@endif
@if (Auth::user()->role == 1)
    <div class="row form-group">

        <label for="salary" class="col-sm-1 col-form-label">سعر الحصة</label>
        <div class="col-sm-11">
            <input type="number" step="0.1" value="{{ old('salary') }}" class="form-control" id="salary"
                name="salary" placeholder="ادخل سعر الحصة">

        </div>
    </div>
    @if ($errors->any())
        <div class="row">
            <div class="col-md-1  message pl-3 pr-3 mt-1 ">
            </div>
            <div class="col-md-11  message pl-3 pr-3 mt-1 ">
                @if ($errors->has('salary'))
                    <div class="text-light text-center bg-secondary pt-2 pb-2">
                        {{ $errors->first('salary') }}</div>
                @endif
            </div>



        </div>
    @endif
@endif
    <div class="row form-group">

        <label for="date" class="col-sm-1 col-form-label">تاريخ الحضور</label>
        <div class="col-sm-11">
            <input type="date" step="0.1" value="{{ old('date') }}" class="form-control" id="date"
                name="date" placeholder="ادخل تاريخ الحضور">

        </div>
    </div>
    @if ($errors->any())
        <div class="row">
            <div class="col-md-1  message pl-3 pr-3 mt-1 ">
            </div>
            <div class="col-md-11  message pl-3 pr-3 mt-1 ">
                @if ($errors->has('date'))
                    <div class="text-light text-center bg-secondary pt-2 pb-2">
                        {{ $errors->first('date') }}</div>
                @endif
            </div>



        </div>
    @endif

<div class="row mt-3 form-group">
    <label for="comment" class="col-sm-1 col-form-label">الملاحظات</label>
    <div class="col-sm-11">
        <textarea class="form-control" rows="4" name="comment" id="comment" value=""
            placeholder="الملاحظات فى حالة ان وجد"></textarea>
    </div>

</div>
@if ($errors->any())
    <div class="row">

        <div class="col-md-1  message pl-3 pr-3 mt-1 ">
        </div>
        <div class="col-md-11  message pl-3 pr-3 mt-1 ">
            @if ($errors->has('comment'))
                <div class="text-light text-center bg-secondary pt-2 pb-2">{{ $errors->first('comment') }}</div>
            @endif
        </div>




    </div>
@endif

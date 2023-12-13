    <label for="name" class="col-sm-1 col-form-label">اسم المدرس</label>
    <div class="col-sm-3">
        <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name" placeholder="ادخل اسم المدرس">
    </div>

    <label for="subject" class="col-sm-1 col-form-label">اختر المادة</label>
    <div class="col-sm-3">
        <select class="form-control pt-0" id="subject" name="subject" >
            <option selected disabled>اختر اسم المادة</option>
            @foreach ($subjects as $subject)
                <option value="{{ $subject->id }}" {{ $subject->id == old('subject') ? 'selected':'' }}>{{ $subject->name }}</option>
            @endforeach
        </select>
    </div>

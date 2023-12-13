<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">اسم المستخدم</label>
    <div class="col-sm-4">
        <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name"
            placeholder="ادخل اسم المستخدم">
    </div>
    <label for="text_email" class="col-sm-2 col-form-label">البريدالالكتروني</label>
    <div class="col-sm-2">
        <p style="font-size: .9rem">elshreif.academy@</p>
    </div>
    <div class="col-sm-2">
        <input type="text" value="{{ old('text_email') }}" class="form-control" id="text_email" name="text_email"
            placeholder="ادخل الاسم الاول من البريد الالكتروني">
    </div>
    
</div>
@if ($errors->any())
    <div class="row mt-3">
        <div class="col-md-2  message pl-3 pr-3 mt-1 ">
        </div>
        <div class="col-md-4  message pl-3 pr-3 mt-1 ">
            @if ($errors->has('name'))
                <div class="text-light text-center bg-secondary pt-2 pb-2">
                    {{ $errors->first('name') }}</div>
            @endif
        </div>


        <div class="col-md-2  message pl-3 pr-3 mt-1 ">
        </div>
        <div class="col-md-4  message pl-3 pr-3 mt-1 ">
            @if ($errors->has('email'))
                <div class="text-light text-center bg-secondary pt-2 pb-2">
                    {{ $errors->first('email') }}</div>
            @endif
        </div>
    </div>
@endif
<div class="form-group mt-3 row">
    <label for="password" class="col-sm-2 col-form-label">كلمة المرور</label>
    <div class="col-sm-4">
        <input type="password" class="form-control" id="password" name="password"
            placeholder="ادخل كلمة المرور">
    </div>
    <label for="confirmPassword" class="col-sm-2 col-form-label">تاكيد كلمة المرور</label>
    <div class="col-sm-4">
        <input type="password" class="form-control" id="confirmPassword"
            name="confirmPassword" placeholder="ادخل تاكيد كلمة المرور">
    </div>

</div>
@if ($errors->any())
    <div class="row mt-3">
        <div class="col-md-2  message pl-3 pr-3 mt-1 ">
        </div>
        <div class="col-md-10  message pl-3 pr-3 mt-1 ">
            @if ($errors->has('password'))
                <div class="text-light text-center bg-secondary pt-2 pb-2">
                    {{ $errors->first('password') }}</div>
            @endif
        </div>



    </div>
@endif
<div class="form-group mt-3 row">
    <label for="role" class="col-sm-2 col-form-label">رتبة المستخدم</label>
    <div class="col-sm-10">
        <select value="{{ old('role') }}" class="form-control pt-1" id="role" name="role">
            <option selected disabled>اختر رتبة المستخدم</option>
            <option value="1" {{ Old('role') == 1 ? 'selected' : '' }}>مدير</option>
            <option value="0" {{ Old('role') == 0 ? 'selected' : '' }}>مشرف</option>
        </select>
    </div>
</div>

@if ($errors->any())
    <div class="row mt-3">
        <div class="col-md-2  message pl-3 pr-3 mt-1 ">
        </div>
        <div class="col-md-10  message pl-3 pr-3 mt-1 ">
            @if ($errors->has('role'))
                <div class="text-light text-center bg-secondary pt-2 pb-2">
                    {{ $errors->first('role') }}</div>
            @endif
        </div>



    </div>
@endif

    <div class="row">


        <label for="student" class="col-sm-1 col-form-label">الطالب</label>
        <div class="col-sm-5">
            <select class="form-control p-0 pr-1" id="student" name="student">
                <option selected disabled>اختر الطالب</option>
                @foreach ($rows as $row)
                    @if (old('student') == $row->student_id)
                        <option id="{{ $row->id }}" value="{{ $row->id }}" selected>{{ $row->name }} - {{ $row->Row->name }}
                        </option>
                    @else
                        <option id="{{ $row->id }}" value="{{ $row->id }}">{{ $row->name }} - {{ $row->Row->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <label for="salary" class="col-sm-1 col-form-label">المبلغ</label>
        <div class="col-sm-5">
            <input type="number" class="form-control" id="salary" value="{{ old('salary') }}" name="salary"
                placeholder="ادخل المبلغ المدفوع">
        </div>
    </div>
    @if ($errors->any())
        <div class="row">

            <div class="col-md-1  message pl-3 pr-3 mt-1 ">
            </div>
            <div class="col-md-5  message pl-3 pr-3 mt-1 ">
                @if ($errors->has('student'))
                    <div class="text-light text-center bg-secondary pt-2 pb-2">{{ $errors->first('student') }}</div>
                @endif
            </div>


            <div class="col-md-1  message pl-3 pr-3 mt-1 "></div>
            <div class="col-md-5  message pl-3 pr-3 mt-1 ">
                @if ($errors->has('salary'))
                    <div class="text-light text-center bg-secondary pt-2 pb-2">{{ $errors->first('salary') }}</div>
                @endif
            </div>


        </div>
    @endif

    <div class="row mt-3">
        
        <label for="status" class="col-sm-2 col-form-label">حالة الدفع</label>
        <div class="col-sm-1">
            <input type="radio" class="mt-2 m-0" value="حصة" id="status3" name="status">
        </div>
        <label for="status3" class="col-sm-1 col-form-label">حصة</label>
        <div class="col-sm-1">
            <input type="radio" class="mt-2 m-0" value="كاملة" id="status0" name="status">
        </div>
        <label for="status0" class="col-sm-1 col-form-label">كاملة</label>
        <div class="col-sm-1">
            <input type="radio" class="mt-2 m-0" value="خصم" id="status1" name="status">
        </div>
        <label for="status1" class="col-sm-1 col-form-label">خصم</label>
        <div class="col-sm-1">
            <input type="radio" class="mt-2 m-0" value="اعفاء" id="status2" name="status">
        </div>
        <label for="status2" class="col-sm-1 col-form-label">اعفاء</label>
        <label for="status" class="col-sm-2 col-form-label"></label>

    </div>
    @if ($errors->any())
        <div class="row">

            <div class="col-md-1  message pl-3 pr-3 mt-1 ">
            </div>
            <div class="col-md-11  message pl-3 pr-3 mt-1 ">
                @if ($errors->has('status'))
                    <div class="text-light text-center bg-secondary pt-2 pb-2">{{ $errors->first('status') }}</div>
                @endif
            </div>




        </div>
    @endif
    <div class="row mt-3">
        <label for="notes" class="col-sm-1 col-form-label">الملاحظات</label>
        <div class="col-sm-11">
            <textarea class="form-control" rows="4" name="notes" id="notes" value=""
                placeholder="الملاحظات فى حالة ان وجد"></textarea>
        </div>

    </div>
    @if ($errors->any())
        <div class="row">

            <div class="col-md-1  message pl-3 pr-3 mt-1 ">
            </div>
            <div class="col-md-11  message pl-3 pr-3 mt-1 ">
                @if ($errors->has('notes'))
                    <div class="text-light text-center bg-secondary pt-2 pb-2">{{ $errors->first('notes') }}</div>
                @endif
            </div>




        </div>
    @endif
    @if (Auth::user()->role == 1)
        <div class="row mt-3">
            <label for="admin_notes" class="col-sm-1 col-form-label">ملاحظات المدير</label>
            <div class="col-sm-11">
                <textarea class="form-control" rows="4" name="admin_notes" id="admin_notes" value=""
                    placeholder="الملاحظات فى حالة ان وجد"></textarea>
            </div>

        </div>
        @if ($errors->any())
            <div class="row">

                <div class="col-md-1  message pl-3 pr-3 mt-1 ">
                </div>
                <div class="col-md-11  message pl-3 pr-3 mt-1 ">
                    @if ($errors->has('admin_notes'))
                        <div class="text-light text-center bg-secondary pt-2 pb-2">
                            {{ $errors->first('admin_notes') }}</div>
                    @endif
                </div>




            </div>
        @endif
    @endif

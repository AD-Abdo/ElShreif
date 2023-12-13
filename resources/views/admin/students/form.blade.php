    <div class="row">
        <label for="name" class="col-sm-1 col-form-label">اسم الطالب</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="name" value="{{ old('name') }}" name="name"
                placeholder="ادخل اسم الطالب">
        </div>
        <label for="phone" class="col-sm-1 col-form-label">رقم هاتف الطالب (1)</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="phone" value="{{ old('phone') }}" name="phone"
                placeholder="ادخل رقم هاتف الطالب (1)">
        </div>
    </div>
    @if ($errors->any())
        <div class="row">

            <div class="col-md-1  message pl-3 pr-3 mt-1 ">
            </div>
            <div class="col-md-5  message pl-3 pr-3 mt-1 ">
                @if ($errors->has('name'))
                    <div class="text-light text-center bg-secondary pt-2 pb-2">{{ $errors->first('name') }}</div>
                @endif
            </div>


            <div class="col-md-1  message pl-3 pr-3 mt-1 ">
            </div>
            <div class="col-md-5  message pl-3 pr-3 mt-1 ">
                @if ($errors->has('phone'))
                    <div class="text-light text-center bg-secondary pt-2 pb-2">{{ $errors->first('phone') }}</div>
                @endif
            </div>


        </div>
    @endif
    <div class="row mt-3">

        <label for="phone2" class="col-sm-1 col-form-label">رقم هاتف الطالب (2)</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="phone2" value="{{ old('phone2') }}" name="phone2"
                placeholder="ادخل رقم هاتف الطالب (2)">
        </div>
        <label for="row" class="col-sm-1 col-form-label">الصف</label>
        <div class="col-sm-5">
            <select class="form-control p-0 pr-1" id="row" name="row">
                <option selected disabled>اختر الصف</option>
                @foreach ($rows as $row)
                    @if (old('row') == $row->id)
                        <option id="{{ $row->id }}" value="{{ $row->id }}" selected>{{ $row->name }}</option>
                    @else
                        <option id="{{ $row->id }}" value="{{ $row->id }}">{{ $row->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    @if ($errors->any())
        <div class="row">

            <div class="col-md-1  message pl-3 pr-3 mt-1 ">
            </div>
            <div class="col-md-5  message pl-3 pr-3 mt-1 ">
                @if ($errors->has('phone2'))
                    <div class="text-light text-center bg-secondary pt-2 pb-2">{{ $errors->first('phone2') }}</div>
                @endif
            </div>


            <div class="col-md-1  message pl-3 pr-3 mt-1 "></div>
            <div class="col-md-5  message pl-3 pr-3 mt-1 ">
                @if ($errors->has('row'))
                    <div class="text-light text-center bg-secondary pt-2 pb-2">{{ $errors->first('row') }}</div>
                @endif
            </div>


        </div>
    @endif

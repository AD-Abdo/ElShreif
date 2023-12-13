    <div class="row">


        <label for="title" class="col-sm-1 col-form-label">العنوان</label>
        <div class="col-sm-5">
            <input type="title" class="form-control" id="title" value="{{ old('title') }}" name="title"
                placeholder="ادخل عنوان الجدول">
        </div>
        <label for="image" class="col-sm-1 col-form-label">صورة الجدول</label>
        <div class="col-sm-5">
            <input type="file" accept="image/*" class="form-control p-0 pr-1 pt-1" id="image" name="image">
        </div>
    </div>
    @if ($errors->any())
        <div class="row">

            <div class="col-md-1  message pl-3 pr-3 mt-1 ">
            </div>
            <div class="col-md-5  message pl-3 pr-3 mt-1 ">
                @if ($errors->has('title'))
                    <div class="text-light text-center bg-secondary pt-2 pb-2">{{ $errors->first('title') }}</div>
                @endif
            </div>


            <div class="col-md-1  message pl-3 pr-3 mt-1 "></div>
            <div class="col-md-5  message pl-3 pr-3 mt-1 ">
                @if ($errors->has('image'))
                    <div class="text-light text-center bg-secondary pt-2 pb-2">{{ $errors->first('image') }}</div>
                @endif
            </div>


        </div>
    @endif

   
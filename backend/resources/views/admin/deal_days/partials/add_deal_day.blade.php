<div class="add-deal-day-block">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="product">product</label>
            <select class="form-control select2" id="product" name="deals[{{$dealDayCount ?? 0}}][product_id]" required>
                <option value="" disabled selected>Choose</option>
                @foreach($products as $product)
                    <option value="{{$product->id}}">{{$product->title}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="start_date">Start Date</label>
            <div class="">
                <input type="text" autocomplete="off" class="form-control datetimepicker"
                       id="start_date" name="deals[{{$dealDayCount ?? 0}}][date_start]">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label for="end_date">End Date</label>
            <div class="">
                <input type="text" autocomplete="off" class="form-control datetimepicker"
                       id="end_date" name="deals[{{$dealDayCount ?? 0}}][date_end]">
            </div>
        </div>
    </div>
</div>

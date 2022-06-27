@extends('layouts.layouts')


{{--@section('content')--}}

{{--    <div class="row category">--}}
{{--        <select id="category" name="category_id">--}}
{{--            <option>Select Category</option>--}}
{{--            @forelse($model as $item)--}}
{{--                <option value="{{$item->id}}">{{$item->name}}</option>--}}
{{--            @empty--}}
{{--            @endforelse--}}
{{--        </select>--}}

{{--    </div>--}}


{{--@endsection--}}
@section('content')

    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Category
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4 col-md-8" id="here">
                            <label>Select Category</label>
                            <select onchange="myFunction(this)" class="form-control">
                                @forelse($model as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @empty
                                    <option>No Category</option>
                                @endforelse
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bordered table end -->

@endsection

@push('js')

    <script type="application/javascript">

            function myFunction(e){
                var selectedCountry = parseInt($(e).children("option:selected").val());

                $.ajax({
                    method: "get",
                    url: "/api/category/"+selectedCountry,
                    success: function (e) {
                        if (e.data.status === 404) {
                           alert(e.data.message);
                        } else
                            var m = `
                           <select onchange="myFunction(this)" class="form-control mt-1">`;


                            jQuery.each(e.data, function(index, item) {
                             m+=`
                              <option value="`+item.id+`">`+item.name+`</option>`;
                            });

                            m+=`</select>`;
                        $(m).appendTo("#here");
                        }

                });
            }





    </script>

@endpush

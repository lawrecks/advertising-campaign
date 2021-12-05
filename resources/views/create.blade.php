@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Create Campaign</div>

                <div class="card-body">
                    <form action="{{route('create')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text"
                            class="form-control"
                            id="name"
                            required
                            name="name"
                            value="{{old('name')}}"
                            placeholder="Campaign name">
                        </div>
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="from_date" class="form-label">Start Date</label>
                                <input type="date"
                                name="from_date"
                                required
                                class="form-control"
                                value="{{old('from_date')}}"
                                id="from_date">
                            </div>
                            <div class="mb-3 col-6">
                                <label for="to_date" class="form-label">End Date</label>
                                <input type="date"
                                name="to_date"
                                required
                                class="form-control"
                                value="{{old('to_date')}}"
                                id="to_date">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="total_budget" class="form-label">Total Budget</label>
                            <input type="number"
                            name="total_budget"
                            required
                            class="form-control"
                            value="{{old('total_budget')}}"
                            placeholder="Total budget in dollars"
                            id="total_budget">
                        </div>
                        <div class="mb-3">
                            <label for="daily_budget" class="form-label">Daily Budget</label>
                            <input type="number"
                            name="daily_budget"
                            required
                            class="form-control"
                            value="{{old('daily_budget')}}"
                            placeholder="Daily budget in dollars"
                            id="daily_budget">
                        </div>
                        <div class="input-group control-group increment mb-3" >
                            <input type="file" name="images[]" required class="form-control">
                            <div class="input-group-btn">
                                <button class="btn btn-success" type="button" id="add-btn">Add more Images</button>
                            </div>
                        </div>
                        <div class="clone hide">
                            <div class="control-group input-group mb-3">
                                <input type="file" name="images[]" class="form-control">
                                <div class="input-group-btn">
                                    <button class="btn btn-danger" required type="button">Remove</button>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $("#add-btn").click(function(){
            var html = $(".clone").html();
            $(".increment").after(html);
        });

        $("body").on("click",".btn-danger",function(){
            $(this).parents(".control-group").remove();
        });

    });
</script>
@endsection

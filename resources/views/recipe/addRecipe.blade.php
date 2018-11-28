@extends('layouts.app')

@section('content')
<div class="container">
    <h1> New Recipe Form</h1>
    <form method="post" action="{{route('validateRecipe')}}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter a name" class="form-control" required>
        </div>
        <input type="hidden" name="count" value="1" />
        <div class="form-group">
            <label for="fieldsB">Select Ingredients</label>
            <div class="control-group" name='products' id="fieldsB">
                <div id="field1B" class="input-group">
                    <select id="fieldSel1B" class="custom-select">
                        @foreach($products as $product)
                        <option>{{$product->name}}</option>
                        @endforeach
                    </select>
                    <input id="fieldNum1B" class="form-control" type="number" min="1" value="1">
                    <button id="b1B" class="btn add-more" type="button">+</button>
                </div>
            </div>
        </div>

        <div class="row">
            <input type="hidden" name="count" value="1" />
            <div class="control-group" id="fields">
                <label class="control-label" for="field1">Nice Multiple Form Fields</label>
                <div class="controls" id="profs">
                    <form class="input-append">
                        <div id="field">
                            <input autocomplete="off" class="input" id="field1" name="prof1" type="text" placeholder="Type something" data-items="8" />
                            <button id="b1" class="btn add-more" type="button">+</button>
                        </div>
                    </form>
                    <br>
                    <small>Press + to add another form field :)</small>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" name="image" id="image" accept=".png, .jpg, .jpeg">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe your product..."></textarea>
        </div>

        <input type='hidden' value={{ Auth::user()->id }} name='user_id'>

        <div class="form-group">
            <button type="submit" class="btn btn-info"> Add Recipe</button>
        </div>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var next = 1;
        $(".add-more").click(function(e) {
            e.preventDefault();
            var addto = "#field" + next;
            var addRemove = "#field" + (next);
            next = next + 1;
            var newIn = '<input autocomplete="off" class="input form-control" id="field' + next + '" name="field' + next + '" type="text">';
            var newInput = $(newIn);
            var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button></div><div id="field">';
            var removeButton = $(removeBtn);
            $(addto).after(newInput);
            $(addRemove).after(removeButton);
            $("#field" + next).attr('data-source', $(addto).attr('data-source'));
            $("#count").val(next);

            $('.remove-me').click(function(e) {
                e.preventDefault();
                var fieldNum = this.id.charAt(this.id.length - 1);
                var fieldID = "#field" + fieldNum;
                $(this).remove();
                $(fieldID).remove();
            });
        });



    });
</script>
@endsection
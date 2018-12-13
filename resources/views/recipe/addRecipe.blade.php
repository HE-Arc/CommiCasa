@extends('layouts.app')

@section('content')
<div class="container">
    <h1> {{isset($recipeList) ? 'Edit' : 'Add'}} Recipe</h1>
    <form method="post" action="{{isset($recipeList) ? route('editRecipe' ,['id' => $recipeList->id]) : route('validateRecipe')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter a name" class="form-control" required value="{{isset($recipeList) ? $recipeList->name: ''}}">
        </div>


        <div class="form-group">
            @if(isset($recipeList))
            <div class="control-group">
                @if(count($recipes)> 0)
                <label class="control-label" for="tabProd">Old ingredient</label>
                <table class="table table-hover" id="tabProd">
                    <tr>
                        <th>
                            @lang('Product')</th>
                        <th>
                            @lang('Quantity Required')</th>
                        <th>
                            @lang('Delete From Recipe')</th>
                    </tr>
                    @foreach ($recipes as $recipe)

                    <tr>
                        <input type="hidden" name="prodID[]" value="{{$recipe->id}}">
                        <td>
                            {{$recipe->name}}
                        </td>
                        <td>
                            <input name="quantMod[]" class="form-control" type="number" min="1" value="{{$recipe->quantity_required}}">
                        </td>
                        <td>
                            <button class="btn btn-danger" type="button" onclick="location.href='{{route('deleteRecipe', ['idRecipeList' => $recipeList->id, 'idRecipe' => $recipe->id])}}'">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </table>
                @endif
            </div>
            @endif

            <div class="control-group details" id="fields" @if (isset($recipeList))style="display:none"@endif>
                <label class="control-label" for="field">Select a {{isset($recipeList) ? 'new' : ''}} ingredient</label>
                <div id="field" class="form-inline">
                    <div id="field1" style="width: 95%;">
                        <select class="custom-select" style="width: 49.5%;" name="prod[]" required>
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                        </select>
                            <input id="numfield1" name="quant[]" style="width: 49.5%;" class="form-control" type="number" min="1" value="1">

                    </div>
                    <button id="b1" class="btn add-more btn-primary" type="button">+</button>
                </div>
            </div>

        @if (isset($recipeList))
        <input type="hidden" id="addProdOK" name="addProdOK" value="0">
        <button type=button class="btn btn-info" id="more">Add More Ingredients</button>
        @endif
        <input type="hidden" name="count" value="1" />
</div>

<div class="form-group">
    @if(isset($recipeList))
    <img src="{{URL::to("recipes/images/". Auth::user()->id . "/" . $recipeList->image)}}" alt="" height="200" width="200">
    @elseif (isset($recipeList) && $recipeList->image == "default.png")
    <img src=" {{ URL::to('recipes/images/default.png')}}" alt="" height="200" width="200">
    @else
    @endif
    <br>
    <label for="image">Image</label>
    <input type="file" class="form-control-file" name="image" id="image" accept=".png, .jpg, .jpeg">
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe your recipe...">{{isset($recipeList) ? $recipeList->description : ''}}</textarea>
</div>

<input type='hidden' value={{ Auth::user()->id }} name='user_id'>

<div class="form-group">
    <button type="submit" class="btn btn-info"> {{isset($recipeList) ? 'Edit' : 'Add'}} Recipe</button>
</div>
</form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var next = 1;
        var options = '@foreach ($products as $product) <option value="{{$product->id}}">{{$product->name}}</option>@endforeach';
        $(".add-more").click(function(e) {
            e.preventDefault();
            var addto = "#field" + next;
            var addRemove = "#field" + (next);
            next = next + 1;
            var newIn = '<div id="field' + next + '" style="width: 95%;"><select style="width: 49.5%;" class="custom-select" name="prod[]">' + options + '</select><input style="width: 49.5%;" name="quant[]" class="form-control" type="number" min="1" value="1"></div>';
            var newInput = $(newIn);
            var removeBtn = '<button id="remove' + (next - 1) + '" class="btn btn-danger remove-me" >-</button>';
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
        $("#more").click(function(e) {
            $('.details').slideToggle(function() {
                $('#more').html($('.details').is(':visible') ? 'Don\'t Add More Ingredients' : 'Add More Ingredients');
            });
            if ("1" == $("#addProdOK").val())
                $("#addProdOK").val("0");
            else
                $("#addProdOK").val("1");
        });
    });
</script>
@endsection
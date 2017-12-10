<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Ajax ToDo List Project</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style media="screen">

    </style>
  </head>
  <body>
  <br>
  <div class="container">
    <div class="row">
      <div class="col-lg-offset-3 col-lg-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3>Ajax Todo List <a href="#" id="addNew" data-toggle="modal" data-target="#myModal" class="pull-right"><i class="fa fa-plus"></i></a></h3>
          </div>
            <div class="panel-body" id="items">
              <ul class="list-group">
                @foreach ($items as $item)
                  <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">
                    <input type="hidden" id="itemId" value="{{$item->id}}">
                    {{$item->item}}
                  </li>
                @endforeach
              </ul>
            </div>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Add new item</h4>
            </div>
            <div class="modal-body">
              <input type="hidden" id="id">
              <input type="text" class="form-control" name="addItem" value="" placeholder="Write item here" id="addItem">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" id="delete" data-dismiss="modal" style="display:none;">Delete</button>
              <button type="button" class="btn btn-primary" id="saveChanges" data-dismiss="modal" style="display:none;">Save changes</button>
              <button type="button" class="btn btn-primary" id="addButton" data-dismiss="modal">Add Item</button>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  {{csrf_field()}}

  <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {

          $(document).on('click', '.ourItem', function(event) {
            event.preventDefault();
            var text = $(this).text();
            var id = $(this).find('#itemId').val();
            $('#myModalLabel').text('Edit item');
            $('#addItem').val(text);
            $('#delete').show();
            $('#saveChanges').show();
            $('#addButton').hide();
            $('#id').val(id);
          });

          $(document).on('click', '#addNew', function(event) {
            event.preventDefault();
            $('#myModalLabel').text('Add item');
            $('#addItem').val("");
            $('#delete').hide();
            $('#saveChanges').hide();
            $('#addButton').show();
          });

          $('#addButton').click(function(event) {
            var text = $('#addItem').val();
            $.post('list', {'text':text,'_token':$('input[name=_token]').val()}, function(data) {
              $('#items').load(location.href+' #items');
            });
          });

          $('#delete').click(function(event) {
            var id = $('#id').val();
            $.post('delete', {'id':id,'_token':$('input[name=_token]').val()}, function(data) {
                $('#items').load(location.href+' #items');
            });
          });

          $('#saveChanges').click(function(event) {
            var text = $('#addItem').val();
            var id = $('#id').val();
            console.log(text);
            $.post('update', {'id':id,'text':text,'_token':$('input[name=_token]').val()}, function(data) {
                $('#items').load(location.href+' #items');
            });
          });
        });
    </script>

  </body>
</html>

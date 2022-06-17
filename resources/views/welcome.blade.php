<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{{csrf_token()}}" />
    <title>Bincode Generator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
       <h2 class="text-center"> Bincode Generator</h2>
       <form>
        <div class="row">
          <div class="col col-md-4">
            <label for="bincount" class="form-label">Enter number of bincodes you want to generate</label>
            <input type="text" class="form-control" id="bincount">
            <p id='errors'></p>
          </div>
        </div>
        <br>
      <button type="submit" class="btn btn-primary" id="submit-form">Submit</button>
    </form>
    <p>Generated Bincodes:</p>
    <div id="bincodes">
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript">
         $(document).ready(function(){
            $('#submit-form').click(function(e){
               $('#errors').text('');
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                    url: "{{ url('/generate-bincode') }}",
                    method: 'post',
                    data: {
                        bincount: $('#bincount').val(),
                    },
                    success: function(result) {
                        $('#bincodes').text(result);
                    },
                    error: function (xhr) {
                       if (xhr.status == 422) {
                           var errors = JSON.parse(xhr.responseText);
                           $('#errors').text(errors.message);
                       }
                    }
              });
               });
            });
    </script>
  </body>
</html>
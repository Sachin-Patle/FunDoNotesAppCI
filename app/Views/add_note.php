<!DOCTYPE html>
<html>

<head>
  <title>FundoNotes</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 500px;
    }

    .error {
      display: block;
      padding-top: 5px;
      font-size: 14px;
      color: red;
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <form method="post" id="add_create" name="add_create" 
    action="<?= site_url('/submit-form') ?>">
      <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control">
      </div>

      <div class="form-group">
        <label>Note</label>
        <input type="text" name="note" class="form-control">
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Save Details</button>
      </div>
    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/additional-methods.min.js"></script>
  <script>
    if ($("#add_create").length > 0) {
      $("#add_create").validate({
        rules: {
          title: {
            required: true,
          },
          note: {
            required: true,
          },
        },
        messages: {
          name: {
            required: "Title is required.",
          },
          email: {
            required: "Note is required.",
          },
        },
      })
    }
  </script>
</body>

</html>
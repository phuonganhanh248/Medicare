<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>use-bootstrap-toaster Library Examples</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <style>

  </style>
</head>

<body>
  <div class="container">
    <div>
      <div id="carbon-block"></div>
    </div>
    <p>
      <button class="btn btn-primary" id="basic" onclick="basic()">Basic</button>
      <button class="btn btn-primary" id="header" onclick="withHeader()">With Header</button>
      <button class="btn btn-primary" id="bottom" onclick="bottom()">Bottom Right</button>
      <button class="btn btn-primary" id="closeBtn" onclick="closeBtn()">Close Button</button>
      <button class="btn btn-danger" id="theme" onclick="theme()">Danger Theme</button>
    </p>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
  <script src="http://localhost/Medicare/assets/js/toast/use-bootstrap-toaster.min.js"></script>
  <script>
    function basic() {
      toast('<strong>Success!</strong> Event has been created')
    }
    function withHeader() {
      toast({
        header: '<strong class="me-auto">Event has been created</strong><button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="toast">Close</button>',
        body: 'Monday, January 3rd at 6:00pm',
      })
    }
    function bottom() {
      toast({
        body: 'Event has been created',
        placement: 'bottom-right',
      })
    }
    function closeBtn() {
      toast({
        header: {
          title: 'Success',
          closeBtn: true,
        },
        body: 'Event has been created',
        autohide: false,
      })
    }
    function theme() {
      toast({
        classes: `text-bg-danger border-0`,
        body: `
  <div class="d-flex w-100" data-bs-theme="dark">
    <div class="flex-grow-1">
      Hello, world! This is a toast message.
    </div>
    <button type="button" class="btn-close flex-shrink-0" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>`,
      })
    }
  </script>
</body>

</html>
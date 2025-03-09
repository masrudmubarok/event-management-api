<!DOCTYPE html>
<html>
<head>
  <title>Event Management</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
  <h1>Event Management</h1>
  <button id="addEventButton">Add Event</button>
  <table id="eventsTable" class="display">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Date</th>
        <th>Location</th>
        <th>Description</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>

  <div id="eventModal" class="modal">
    <div class="modal-content">
      <span class="close">&times;</span>
      <form id="eventFormSubmit">
        <input type="hidden" id="eventId">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date"><br>
        <label for="location">Location:</label><br>
        <input type="text" id="location" name="location"><br>
        <label for="description">Description:</label><br>
        <textarea id="description" name="description"></textarea><br><br>
        <button type="submit">Submit</button>
        <button type="button" id="cancelButton">Cancel</button>
      </form>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function () {
      var table = $('#eventsTable').DataTable({
        ajax: {
          url: '/api/events',
          dataSrc: ''
        },
        columns: [
          {data: 'id'},
          {data: 'name'},
          {data: 'date'},
          {data: 'location'},
          {data: 'description'},
          {
            data: null,
            render: function (data, type, row) {
              // Use Font Awesome icons for Edit and Delete
              return '<button class="editButton" data-id="' + row.id + '"><i class="fas fa-edit"></i></button> <button class="deleteButton" data-id="' + row.id + '"><i class="fas fa-trash"></i></button>';
            }
          }
        ],
        autoWidth: false,
        columnDefs: [
          {width: "5%", targets: 0, className: "text-center" },
          {width: "20%", targets: 1},
          {width: "15%", targets: 2},
          {width: "25%", targets: 3},
          {width: "25%", targets: 4},
          {width: "10%", targets: 5, className: "text-center" }
        ]
      });

      $('#addEventButton').click(function () {
        $('#eventModal').show();
        $('#eventId').val('');
        $('#name').val('');
        $('#date').val('');
        $('#location').val('');
        $('#description').val('');
      });

      $('.close, #cancelButton').click(function () {
        $('#eventModal').hide();
      });

      $('#eventFormSubmit').submit(function (e) {
        e.preventDefault();
        var eventId = $('#eventId').val();
        var url = eventId ? '/api/events/' + eventId : '/api/events';
        var method = eventId ? 'PUT' : 'POST';

        $.ajax({
          url: url,
          type: method,
          data: JSON.stringify({
            name: $('#name').val(),
            date: $('#date').val(),
            location: $('#location').val(),
            description: $('#description').val()
          }),
          contentType: 'application/json',
          success: function () {
            $('#eventModal').hide();
            table.ajax.reload();
          }
        });
      });

      $('#eventsTable').on('click', '.editButton', function () {
        var eventId = $(this).data('id');
        $.get('/api/events/' + eventId, function (data) {
          $('#eventModal').show();
          $('#eventId').val(data.id);
          $('#name').val(data.name);
          $('#date').val(data.date);
          $('#location').val(data.location);
          $('#description').val(data.description);
        });
      });

      $('#eventsTable').on('click', '.deleteButton', function () {
        var eventId = $(this).data('id');
        if (confirm('Are you sure you want to delete this event?')) {
          $.ajax({
            url: '/api/events/' + eventId,
            type: 'DELETE',
            success: function () {
              table.ajax.reload();
            }
          });
        }
      });
    });
  </script>
</body>
</html>
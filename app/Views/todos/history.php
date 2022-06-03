<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <h3 class="text-center py-5">Todos Completed</h3>

  <div id="notif" class="mb-3">

  </div>

  <table class="table table-striped">
  <thead>
    <tr>
      <th style="width: 85%;">Todo</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody id="list">
    
  </tbody>
  </table>

  <script type="text/javascript">
    getData()
    function getData(){
      $.ajax({
        url: '<?php echo base_url('/todos?status=inactive'); ?>',
        dataType: 'json',
        success: function(data){
          var row = '';
          for(var i = 0;i<data.length;i++){
            row += '<tr>'+
                      '<td>' + data[i].listname + '</td>' +
                      '<td>' + "<div class='d-flex gap-3'> <button class='btn btn-danger btn-sm' onclick='unFinishToDo("+ data[i].id +")'>Belum Selesai</button>" + '</td>' +
                   '</tr>'
          }
          $('#list').html(row);
        }
      })

    }

    function unFinishToDo(id){
      $.ajax({
        type: 'POST',
        url: `/todos/unFinishToDo/${id}`,
        dataType: 'json',
        success: function(data){
          getData()
          var notif;
          notif = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
             data.message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
          '</div>';
          $('#notif').html(notif);
        }
      })
    }
  </script>
<?= $this->endSection('content'); ?>
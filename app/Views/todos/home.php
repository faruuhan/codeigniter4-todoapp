<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <h3 class="text-center py-5">Todos</h3>

  <div id="notif" class="mb-3">

  </div>

  <div class="mb-3">
    <label for="entryTodo" class="form-label">Entry todo</label>
    <input type="text" name="entryTodo" class="form-control" id="entryTodo" placeholder="Doing Task" value="">
    <button type="submit" class="btn btn-primary mt-3" onclick="saveToDo()">Simpan</button>
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
        url: '<?php echo base_url('/todos?status=active'); ?>',
        dataType: 'json',
        success: function(data){
          var row = '';
          for(var i = 0;i<data.length;i++){
            row += '<tr>'+
                      '<td>' + data[i].listname + '</td>' +
                      '<td>' + "<div class='d-flex gap-3'> <button class='btn btn-success btn-sm' onclick='finishToDo("+ data[i].id +")'>Selesai</button> <button class='btn btn-danger btn-sm' onclick='deleteToDo("+ data[i].id +")'>Hapus</button></div>" + '</td>' +
                   '</tr>'
          }
          $('#list').html(row);
        }
      })

    }

    function saveToDo(){
      var entryTodo = document.getElementById('entryTodo').value
      $.ajax({
        type: 'POST',
        url: `/todos/saveToDo`,
        dataType: 'json',
        data:{entryTodo},
        success: function(data){
          getData()
          document.getElementById('entryTodo').value = ""
          var notif;
          notif = '<div class="alert alert-success alert-dismissible fade show" role="alert">' +
             data.message +
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'
          '</div>';
          $('#notif').html(notif);
        }
      })
    }

    function finishToDo(id){
      $.ajax({
        type: 'POST',
        url: `/todos/finishToDo/${id}`,
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

    function deleteToDo(id){
      $.ajax({
        url: `/todos/deleteToDo/${id}`,
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
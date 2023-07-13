<script>
  window.js_base_url = "<? echo base_url(); ?>" + "/index.php/";
  
  const bulan = ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AGT", "SEP", "OKT", "NOV", "DES"];

  const formatOptions = {maximumFractionDigits: 2, minimumFractionDigits: 2};
  const formatting = new Intl.NumberFormat('id-UK', formatOptions);

  var data_dokumen = '';
  var data_disposisi = '';


  

  var tbl = $("#tbl_petak_aff").DataTable({
    'select' : 'single',
    'data': '',
    columns : [
      {
        data: "kode_blok",
      },
      {
        data:"",
        render: function(data, type, row, meta){
          return row['deskripsi_blok'];
        }
      },
      {
        className:"dt-body-right",
        data:"",
        render: function(data, type, row, meta){
          $luas = parseFloat(row['luas_tanam']);
          return formatting.format($luas);
        }
      },
      {
        data: "",
        render: function(data, type, row, meta){
          $ktg = row['mature'] - 1;
          return $ktg+'/'+row['mature'];
        }
      }
    ],
    'ordering' : false
  });

  /*
  tbl_inbox.on('select', function(e, dt, type, indexes){
    if (type == 'row'){
      var data = tbl_inbox.rows(indexes).data()[0];
      //console.log(data);
      if (data['id_disposisi'] != null){
        window.location.href = window.js_base_url + "baca/disposisi/" + data['id_disposisi'];
      } else {
        window.location.href = window.js_base_url + "baca/" + data['id_surat'];
      }
    }
  });
  */

  $('tbody').css('cursor', 'pointer');
  
  function defaultLoad(){
    /*
    $.getJSON(js_base_url + 'cek_inbox', function(response){
      //console.log(response);
      data_dokumen = response;
      $.getJSON(js_base_url + 'cek_disposisi', function(response){
        console.log(response);
        data_disposisi = response;
        tbl.clear();
        tbl.rows.add(data_dokumen);
        tbl.rows.add(data_disposisi);
        tbl.draw();
        return false;
      })
      return false;
    })
    */
    $.getJSON(js_base_url + 'getAllPetakAff', function(response){
      console.log(response);
      data_petak = response;
      tbl.clear();
      tbl.rows.add(data_petak);
      tbl.draw();
      return false;
    })
  }

</script>

<script>
  function appendLeadingZeroes(n){
    if (n <= 9){
      return "0" + n;
    }
    return n;
  }
</script>

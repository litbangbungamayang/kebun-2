<script>
  window.js_base_url = "<? echo base_url(); ?>" + "/index.php/";
  
  const bulan = ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AGT", "SEP", "OKT", "NOV", "DES"];

  const formatOptions = {maximumFractionDigits: 2, minimumFractionDigits: 2};
  const formatting = new Intl.NumberFormat('id-UK', formatOptions);

  var data_dokumen = '';
  var data_disposisi = '';


  

  var tbl_inbox = $("#tbl_inbox").DataTable({
    'select' : 'single',
    /*
    'ajax' : {
      'url': js_base_url + 'cek_inbox',
      'dataSrc' : ''
    },
    */
    'data': '',
    columns : [
      {
        data: "jenis_dokumen",
        render: function(data, type, row, meta){
          txt_output = '';
          jenis_dokumen = ''
          //--------------- DISPOSISI
          if (row['id_disposisi'] != null){
            jenis_dokumen = 'DISPOSISI';
          } else {
            jenis_dokumen = data;
          }
          //-------------------------
          
          if(row['status_dokumen'] == '1'){
            txt_output = "<b>" + jenis_dokumen + "</b>";
          } else {
            txt_output = data;
          }
          sifat = row['sifat_dokumen'] == 'RAHASIA' ? "<span class='badge bg-red-lt'>" + row['sifat_dokumen'] + "</span>" : "";
          return "<div style='text-transform:uppercase'>" + txt_output + "  " + sifat + "</div>";
        }
      },
      {
        data: "perihal_dokumen",
        render: function(data, type, row, meta){
          return "<b>" + data + "</b><br><br><span>" + "Dari : " + row['nm_sub_asal_dokumen'] + "<hr hr class='mt-1 mb-1'>" + "Nomor : " + row['nomor_dokumen'] + "</span>";
        }
      },
      {
        data:"",
        render: function(data, type, row, meta){
          icon_unread = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-inbox' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='red' fill='none' stroke-linecap='round' stroke-linejoin='round'> <path stroke='none' d='M0 0h24v24H0z' fill='none'></path><path d='M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z'></path><path d='M4 13h3l3 3h4l3 -3h3'></path></svg>";
          icon_read = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-mail-opened' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='green' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><path d='M3 9l9 6l9 -6l-9 -6l-9 6'></path><path d='M21 9v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10'></path><path d='M3 19l6 -6'></path><path d='M15 13l6 6'></path></svg>";
          icon_disposisi = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-arrow-guide' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><path d='M5 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0'></path><path d='M7 19h3a2 2 0 0 0 2 -2v-8a2 2 0 0 1 2 -2h7'></path><path d='M18 4l3 3l-3 3'></path></svg>";
          icon_done = "<svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-file-check' width='24' height='24' viewBox='0 0 24 24' stroke-width='2' stroke='currentColor' fill='none' stroke-linecap='round' stroke-linejoin='round'><path stroke='none' d='M0 0h24v24H0z' fill='none'></path><path d='M14 3v4a1 1 0 0 0 1 1h4'></path><path d='M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z'></path> <path d='M9 15l2 2l4 -4'></path></svg>";
          status_dokumen = '';
          switch(row['status_dokumen']){
            case '1':
              status_dokumen = icon_unread + " Belum dibaca";
              break;
            case '2':
              status_dokumen = icon_read + " Sudah dibaca";
              break;
          }
          return status_dokumen;
        }
      },
      {
        data: "tgl_diterima",
        render: function(data, type, row, meta){
          return data;
        }
      }
    ],
    'ordering' : false
  });

  tbl_inbox.on('select', function(e, dt, type, indexes){
    if (type == 'row'){
      var data = tbl_inbox.rows(indexes).data()[0];
      console.log(data);
      if (data['id_disposisi'] != null){
        window.location.href = window.js_base_url + "baca/disposisi/" + data['id_disposisi'];
      } else {
        window.location.href = window.js_base_url + "baca/" + data['id_surat'];
      }
      //window.location.href = window.js_base_url + "baca/" + data;
    }
  });

  $('tbody').css('cursor', 'pointer');
  
  function defaultLoad(){
    $.getJSON(js_base_url + 'cek_inbox', function(response){
      //console.log(response);
      data_dokumen = response;
      $.getJSON(js_base_url + 'cek_disposisi', function(response){
        //console.log(response);
        data_disposisi = response;
        tbl_inbox.clear();
        tbl_inbox.rows.add(data_dokumen);
        tbl_inbox.rows.add(data_disposisi);
        tbl_inbox.draw();
        return false;
      })
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

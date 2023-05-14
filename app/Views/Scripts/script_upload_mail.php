<script>
  window.js_base_url = "<? echo base_url(); ?>" + "/index.php/";
  
  const bulan = ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AGT", "SEP", "OKT", "NOV", "DES"];

  const formatOptions = {maximumFractionDigits: 2, minimumFractionDigits: 2};
  const formatting = new Intl.NumberFormat('id-UK', formatOptions);

  /******* COMPONENT DECLARATIONS ********/
  var $cbxAsalDokumen, cbxAsalDokumen;
  var $cbxSubAsalDokumen, cbxSubAsalDokumen;
  var $cbxJenisDokumen, cbxJenisDokumen;
  var $cbxTujuanDokumen, cbxTujuanDokumen;
  var dpTglDokumen = $("#tgl_dokumen");
  var idAsalDokumen;
  
  function defaultLoad(){
    
  }

  

  $cbxJenisDokumen = $("#jns_dokumen").selectize({
    valueField: 'id',
    labelField: 'jns_dokumen',
    sortField: 'jns_dokumen',
    searchField: 'jns_dokumen',
    maxItems: 1,
    create: false,
    placeholder: "Pilih jenis dokumen..",
    options: [
      {id: 'surat', jns_dokumen: 'Surat'},
      {id: 'memo', jns_dokumen: 'Memo'}
    ]
  })
  cbxJenisDokumen = $cbxJenisDokumen[0].selectize;


  $cbxSubAsalDokumen = $("#sub_asal_dokumen").selectize({
    valueField: "id_sub_asal",
    labelField: "nm_sub_asal_dokumen",
    sortField: "id_sub_asal",
    searchField: "nm_sub_asal_dokumen",
    maxItems: 1,
    create: true,
    placeholder: "Sub bagian/instansi",
    create: function(input, callback){
      $.ajax({
        url: js_base_url + 'C_mail/postSubAsalDokumen',
        type: 'POST',
        data: {
          'nm_sub_asal_dokumen' : input.toUpperCase(),
          'id_asal_dokumen' : idAsalDokumen
          },
        dataType : 'json',
        success: function(res){
          if (!isNaN(res)){
            callback({value: res, text: input.toUpperCase()});
            $.ajax({
              url: js_base_url + 'C_mail/getSubAsalDokumen',
              type: 'GET',
              dataType: 'json',
              data: 'id_asal=' + idAsalDokumen,
              success: function(response){
                cbxSubAsalDokumen.load(function (callback){
                  callback(response);
                })
              }
            })
            //return {value: res, text: input.toUpperCase()};
            //alert("Loaded!");
            //cbxSubAsalDokumen.setValue(res);
          }
        }
      })
    },
    createOnBlur: false
  })
  cbxSubAsalDokumen = $cbxSubAsalDokumen[0].selectize;

  $.ajax({
    url: js_base_url + 'C_mail/getTujuanDokumen',
    type: 'GET',
    dataType: 'json',
    success: function(response){
      //console.log(response);
      $cbxTujuanDokumen = $("#tujuan_dokumen").selectize({
        valueField: 'id_pegawai',
        labelField: 'opsi',
        sortField: 'level_jabatan',
        searchField: 'opsi',
        maxItems: 1,
        create: false,
        placeholder: 'Pilih tujuan surat..',
        options: response
      })
      cbxTujuanDokumen = $cbxTujuanDokumen[0].selectize;
    }
  })

  $.ajax({
    url: js_base_url + "C_mail/getAsalDokumen",
    type: 'GET',
    dataType: 'json',
    success: function(response){
      //console.log(response);
      var isian = response;
      $cbxAsalDokumen = $("#asal_dokumen").selectize({
        valueField: "id_asal_dokumen",
        labelField: "nm_asal_dokumen",
        sortField: "id_asal_dokumen",
        searchField: "nm_asal_dokumen",
        maxItems: 1,
        create: false,
        placeholder: "Pilih asal dokumen..",
        options: isian,
        onChange: function(value){
          cbxSubAsalDokumen.disable();
          cbxSubAsalDokumen.clear();
          cbxSubAsalDokumen.clearOptions();
          idAsalDokumen = value;
          $.ajax({
            url: js_base_url + 'C_mail/getSubAsalDokumen',
            type: 'GET',
            dataType: 'json',
            data: 'id_asal=' + value,
            success: function(response){
              //console.log(response);
              cbxSubAsalDokumen.enable();
              cbxSubAsalDokumen.load(function (callback){
                callback(response);
              })
              /*
              cbxSubAsalDokumen.on('change', function(){
                //console.log(cbxSubAsalDokumen.getValue());
                if(isNaN(cbxSubAsalDokumen.getValue())){
                  dataBaru = cbxSubAsalDokumen.getValue();
                  dataBaru = dataBaru.toUpperCase();
                  $.ajax({
                    url: js_base_url + 'C_mail/postSubAsalDokumen',
                    type: 'POST',
                    data: {
                      'nm_sub_asal_dokumen' : dataBaru,
                      'id_asal_dokumen' : value
                      },
                    dataType : 'json',
                    success: function(msg){
                      cbxSubAsalDokumen.addOption({value: msg, text: dataBaru.toUpperCase()});
                      cbxSubAsalDokumen.addItem(msg);
                    }
                  })
                }
              })
              */
            }
          })
        }
      })
      cbxAsalDokumen = $cbxAsalDokumen[0].selectize;
      cbxSubAsalDokumen.disable();
    }
  })

  function convertArrayToNumber(arrToConvert){
    if (Array.isArray(arrToConvert)){
      var arrResult = [];
      for (var i = 0; i < arrToConvert.length; i++){
        if (arrToConvert[i] !== null){
          arrResult[i] = parseFloat(parseFloat(arrToConvert[i]).toFixed(2));
        } else {
          arrResult[i] = null;
        }
      }
      return arrResult;
    } else {
      return null;
    }
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

<script>
  window.js_base_url = "<? echo base_url(); ?>" + "/index.php/";
  
  const bulan = ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AGT", "SEP", "OKT", "NOV", "DES"];

  const formatOptions = {maximumFractionDigits: 2, minimumFractionDigits: 2};
  const formatting = new Intl.NumberFormat('id-UK', formatOptions);

  /******* COMPONENT DECLARATIONS ********/
  var $cbxAsalDokumen, cbxAsalDokumen;
  var $cbxSubAsalDokumen, cbxSubAsalDokumen;
  var $cbxJenisDokumen, cbxJenisDokumen;
  
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

  $.ajax({
    url: js_base_url + "C_mail/getAsalDokumen",
    type: 'GET',
    dataType: 'json',
    success: function(response){
      console.log(response);
      var isian = response;
      $cbxAsalDokumen = $("#asal_dokumen").selectize({
        valueField: "id_asal_dokumen",
        labelField: "nm_asal_dokumen",
        sortField: "id_asal_dokumen",
        searchField: "nm_asal_dokumen",
        maxItems: 1,
        create: true,
        placeholder: "Pilih asal dokumen..",
        options: isian
      })
      cbxAsalDokumen = $cbxAsalDokumen[0].selectize;
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

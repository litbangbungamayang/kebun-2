<script>
  window.js_base_url = "<? echo base_url(); ?>" + "/index.php/";
  
  const bulan = ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AGT", "SEP", "OKT", "NOV", "DES"];

  const formatOptions_dec = {maximumFractionDigits: 2, minimumFractionDigits: 2};
  const formatting_dec = new Intl.NumberFormat('id-UK', formatOptions_dec);

  const formatOptions_int = {maximumFractionDigits: 0, minimumFractionDigits: 0};
  const formatting_int = new Intl.NumberFormat('id-UK', formatOptions_int);

  const kantor_lat = -5.3706477; //-5.3706477;
  const kantor_lon = 105.2280522; //105.2280522;

  var lblDateTime = $("#lblDateTime");
  var lblCekIn = $("#lblCekIn");
  var lblCekOut = $("#lblCekOut");
  var chkDinas = $("#chkDinas");
  var btnSubmitPresensi = $("#btnSubmitPresensi");
  var actual_lat = 0.0;
  var actual_lon = 0.0;
  var accuracy = 0;
  var dummy = 0;

  
  function defaultLoad(){
  
    refreshData();
    setInterval(function(){ refreshData() }, 1000);
    cekPresensi();
    /* TES GPS LOCATION */
    getLocation();
    /********************/
  }
  

  function getLocation(){
    if(navigator.geolocation){
      navigator.geolocation.getCurrentPosition(logPosition);
      navigator.geolocation.getCurrentPosition(fixedPosition);
    } else {
      alert("Geolocation is not supported");
    }
  }

  function logPosition(position){
    console.log(position.coords.latitude + "," + position.coords.longitude);
    //lblCekIn.text(position.coords.latitude + ", " + position.coords.longitude);
    //lblCekOut.text(distance(position.coords.latitude, position.coords.longitude, kantor_lat, kantor_long, 'K') + " km");
  }

  function fixedPosition(position){
    actual_lat = position.coords.latitude;
    actual_lon = position.coords.longitude;
    accuracy = position.coords.accuracy;
    if (dummy == 1){
      actual_lat = kantor_lat;
      actual_lon = kantor_lon;
      accuracy = 10;
    }
  }

  function cekPresensi(){
    var url = js_base_url + "C_user/cekPresensi";
    $.getJSON(url, function(response){
      console.log(response);
      if(response !== null){
        lblCekIn.text(response['cek_in']);
        if(response['cek_out'] !== null) {
          lblCekOut.text(response['cek_out']);
        }
      }
    })
  }

  function konfirmasiPresensi(){
    if (lblCekIn.text() == ''){
      if (confirm('Submit presensi kedatangan?')){submitPresensi()};
    } else {
      if (lblCekIn.text() != '' && lblCekOut.text() == '' ){
        if (confirm("Submit presensi pulang?")){submitPresensi()};
      }
    }
  }

  function submitPresensi(){
    getLocation();
    var dinas = chkDinas.prop('checked');
    if (accuracy < 1000 && accuracy >= 0){
      var url = js_base_url + "C_user/cekLokasi?lat=" + actual_lat + "&lon=" + actual_lon + "&acc=" + accuracy + "&dl=" + dinas;
      $.getJSON(url, function(response){
        console.log(response);
        alert(response['msg']);
        chkDinas.prop('checked', false);
        cekPresensi();
      })
    } else {
      alert("Harap cek kembali akurasi GPS Anda. Nilai akurasi > 1000 meter tidak dapat melakukan submit presensi. (Aktual = " + formatting_int.format(accuracy || 0) + " meter).");
    }
  }

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
  function refreshData(){
    var currentDate = new Date();
    lblDateTime.text((currentDate.getDate()<10 ? '0' : '') + currentDate.getDate() + "-" + (currentDate.getMonth()<10 ? '0' : '') + (currentDate.getMonth() + 1) + "-" + currentDate.getFullYear() + "  " + (currentDate.getHours()<10 ? '0' : '') + currentDate.getHours() + ":" + (currentDate.getMinutes()<10 ? '0' : '') + currentDate.getMinutes() + ":" + (currentDate.getSeconds()<10 ? '0' : '') + currentDate.getSeconds());
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

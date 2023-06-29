<script>
  window.js_base_url = "<? echo base_url(); ?>" + "/index.php/";
  
  const bulan = ["JAN", "FEB", "MAR", "APR", "MEI", "JUN", "JUL", "AGT", "SEP", "OKT", "NOV", "DES"];

  const formatOptions = {maximumFractionDigits: 2, minimumFractionDigits: 2};
  const formatting = new Intl.NumberFormat('id-UK', formatOptions);
  
  function defaultLoad(){
    /*
    refreshData();
    setInterval(function(){ refreshData() }, 5000);
    */
    /* TES GPS LOCATION */
    getLocation();
    /********************/
  }

  function getLocation(){
    if(navigator.geolocation){
      navigator.geolocation.getCurrentPosition(logPosition);
    } else {
      alert("Geolocation is not supported");
    }
  }

  function logPosition(position){
    //console.log(position.coords.latitude + "," + position.coords.longitude);
    //alert(position.coords.latitude + "," + position.coords.longitude);
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
  function appendLeadingZeroes(n){
    if (n <= 9){
      return "0" + n;
    }
    return n;
  }
</script>

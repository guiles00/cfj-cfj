$(document).ready(function() {
/*Custom validator*/
//DNI 
jQuery.validator.addMethod("dni", function(value, element) {
  return this.optional(element) || /^\d{6,8}$/.test(value);
}, "Entre 6 y 8 caracteres y s&oacute;lo n&uacute;meros");
//Legajo
jQuery.validator.addMethod("legajo", function(value, element) {
  return this.optional(element) || /^\d{1,4}$/.test(value);
}, "Hasta 4 caracteres y s&oacute;lo n&uacute;meros");
//Telefono
jQuery.validator.addMethod("tel", function(value, element) {
  return this.optional(element) || /^\d{6,8}$/.test(value);
}, "Entre 6 y 8 caracteres y s&oacute;lo n&uacute;meros");

//Email
jQuery.validator.addMethod("email", function(value, element) {
  
  if(value.indexOf('@') < 0) return this.optional(element);

  if(value.split('@')[1] == 'jusbaires.gov.ar') return true;

    return this.optional(element);
}, "El email tiene que ser de @jusbaires.gov.ar");
//Hora

jQuery.validator.addMethod("horas", function(value, element) {
  return this.optional(element) || /^\d{1,3}$/.test(value);
}, "S&oacute;lo n&uacute;meros y hasta 999 horas");


jQuery.validator.addMethod("costo", function(value, element) {
   
   //if(parseFloat(value) > 13478.40) return false;
   //if(parseFloat(value) > 1000000) return false;

   if( /^(\d+|\d+.\d{1,2})$/.test(value) ) return true;

   return this.optional(element);
   // (El monto no puede superar 1000.000$)
}, "S&oacute;lo hasta dos decimales con punto");


jQuery.validator.addMethod("monto", function(value, element) {
   
   //traigo si es curso/carrera/actividad
   var tipo = $('#g_tipo_actividad_id').val();
   var valor = 14976;   

   if(tipo == 1){
    //13478.40
    if(parseFloat(value) > (valor*.9)) return false;

   }else if(tipo == 2){
    if(parseFloat(value) > (valor*.8)) return false;    
   }else if(tipo == 3){
    if(parseFloat(value) > (valor*.5)) return false;
   }

   //if(parseFloat(value) > 13478.40) return false;

   if( /^(\d+|\d+.\d{1,2})$/.test(value) ) return true;

   return this.optional(element); //13478.40$
}, "Supera el Monto aprobado (S&oacute;lo hasta dos decimales con punto)");


jQuery.validator.addMethod("dependencia_id", function(value, element) {
   
   //traigo si es curso/carrera/actividad
   var b_dependencia_id = $('#b_dependencia_id').val();
   console.debug(b_dependencia_id);
   if(b_dependencia_id == 0){
    return false;
   }
    if(b_dependencia_id == -1){
        
        var dep_otro = $('#b_dependencia_otro').val();
        if(dep_otro == '') return false;

   }

   return true;// return this.optional(element); //13478.40$
}, "Elegi una dependencia");


jQuery.validator.addMethod("cargo_id", function(value, element) {
   
   //traigo si es curso/carrera/actividad
   var b_cargo = $('#b_cargo').val();
   
   if(b_cargo == 0){
    return false;
   }

   return true;//this.optional(element); //13478.40$
}, "Ingrese cargo");

jQuery.validator.addMethod("universidad_id", function(value, element) {
   
   var b_universidad_id = $('#b_universidad_id').val();
   
   if(b_universidad_id == 0){
     return false;
   }
   if(b_universidad_id == -1){
    console.debug('entra aca en universidad');
        
        var uni_otro = $('#b_universidad_otro').val();
        if(uni_otro == '') return false;

   }

   return true;//this.optional(element); //13478.40$
}, "Complete Universidad");

jQuery.validator.addMethod("facultad_id", function(value, element) {
   
   var b_facultad_id = $('#b_facultad_id').val();
   
   if(b_facultad_id == 0){
     return false;
   }
   if(b_facultad_id == -1){
        
        var fac_otro = $('#b_facultad_otro').val();
        if(fac_otro == '') return false;

   }

   return true;//this.optional(element); //13478.40$
}, "Complete Facultad");

jQuery.validator.addMethod("titulo_id", function(value, element) {
   
   var b_titulo_id = $('#b_titulo_id').val();
   
   if(b_titulo_id == 0){
     return false;
   }
   if(b_titulo_id == -1){
        
        var tit_otro = $('#b_titulo_otro').val();
        if(tit_otro == '') return false;

   }

   return true;//this.optional(element); //13478.40$
}, "Complete Titulo");


/**/

    $('#g_formulario_beca').validate(
        {
            rules:{
               /* nombre: "required"
                ,
                apellido: "required"
                ,
                nro_documento:{
                    required:true
                    ,dni : { dni : true }
                }
                ,legajo:{
                    required:true
                    ,legajo : { legajo : true }
                }
                ,tel:{
                    required:true
                    ,tel : { tel : true }
                }
                ,domicilio:{
                    required:true
                }
                ,telefono_laboral:{
                    required:true
                }
                ,
                password: "required"
                ,password_again: {
                    equalTo: "#password"
                }
                ,
                email: {
                    required:true
                    ,email : { email : true }
                }
                ,r_email: {
                    equalTo: "#g_email"
                }
                ,cargo_id:
                {
                    required: true
                    ,cargo_id: {cargo_id:true}
                },universidad_id:
                {
                    required: true
                    ,universidad_id: {universidad_id:true}
                },facultad_id:
                {
                    required: true
                    ,facultad_id: {facultad_id:true}
                },titulo_id:
                {
                    required: true
                    ,titulo_id: {titulo_id:true}
                },dependencia_id:
                {
                    required: true
                    ,dependencia_id: {dependencia_id:true}
                }///HASTA ACA ESTA BIEN
                ,duracion: {
                    required: true
                    ,horas: {horas:true}
                }
                ,costo: {
                    required: true
                    ,costo: {costo:true}
                }
                ,monto: {
                    required: true
                    ,monto: {monto:true}
                }
                ,dependencia_label:"required"
                ,dependencia_id:"required"
                ,facultad_label:"required"
                ,titulo_label:"required"
                ,cargo_acutal_label:"required"
                ,f_ingreso_caba:"required"
                ,universidad_label:"required"
                ,inst_prop_id:"required"
                */

            }
            ,messages: {
                nro_documento: {
                    required: "Este campo es obligatorio"
                }
                ,legajo: {
                    required: "Este campo es obligatorio"
                }
                ,tel: {
                    required: "Este campo es obligatorio"   
                }
                ,telefono_laboral: {
                    required: "Este campo es obligatorio"   
                }
                ,domicilio: {
                    required: "Este campo es obligatorio"   
                }
                ,email:{
                    required:"Este campo es obligatorio"
                }
                ,r_email:{
                    equalTo:"Los correos deben coincidir"
                }
                ,nombre:{
                    required:"Este campo es obligatorio"
                }
                ,apellido:{
                    required:"Este campo es obligatorio"
                }
                ,facultad_label:{
                    required:"Este campo es obligatorio"
                }
                ,titulo_label:{
                    required:"Este campo es obligatorio"
                }
                ,cargo_actual_label:{
                    required:"Este campo es obligatorio"
                }
                ,f_ingreso_caba:{
                    required:"Este campo es obligatorio"
                }
                ,universidad_label:{
                    required:"Este campo es obligatorio"
                }
                ,dependencia_label:{
                    required:"Este campo es obligatorio"
                }
                ,inst_prop_id:{
                    required:"Este campo es obligatorio"
                }
            }

        }
    );	
    
    $('#g_tipo_actividad_id').change(function(){

        var tipo = $('#g_tipo_actividad_id').val();

           var valor = 14976;   
           if(tipo == 1){
            //13478.40
           // if(parseFloat(value) > (valor*.9)) return false;
           var max = parseFloat((14976*.9)).toFixed(2);
            $('#g_monto_show').html('Monto Solicitado(M&aacute;x. '+max+'$)');
           }else if(tipo == 2){
            
           var max = parseFloat((14976*.8)).toFixed(2);
            $('#g_monto_show').html('Monto Solicitado(M&aacute;x. '+max+'$)');
           }else if(tipo == 3){
            
            var max = parseFloat((14976*.5)).toFixed(2);
            $('#g_monto_show').html('Monto Solicitado(M&aacute;x. '+max+'$)');
           }

        
    });
    

    $('#g_dni').focus();

    $('#g_dni').focusout(function(){
		
		var dni = $('#g_dni').val();
        $.ajax({
                url : "./get_alumno.php"
                ,data:{ 'dni': dni }
                ,success : function(result) {
                var res = JSON.parse(result);
                    if(res.usi_nombre){ //Si trajo datos voy a completar domicilio
						$('#g_nombre').val(res.usi_nombre);
						//$('#g_apellido').val(res.apellido);
						$('#g_legajo').val(res.usi_legajo);
						$('#g_domicilio').focus();
		       		}
                }
              });    	
    });


/* $.getJSON("cargo.php", function (data) {
        $("#g_cargo_actual_label").autocomplete({
            source: data
            ,focus: function(event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
            // manually update the textbox
            $(this).val(ui.item.label);
            }
            ,select: function(event, ui){
            event.preventDefault();
            $(this).val(ui.item.label);
            
            var a = $('#g_cargo_actual_id').val(ui.item.value);
            //console.debug(a.val());
            }
        });
    });
*/
 /*$.getJSON("dependencia.php", function (data) {
        $("#g_dependencia_label").autocomplete({
            source: data
            ,focus: function(event, ui) {
            // prevent autocomplete from updating the textbox
            //event.preventDefault();
            // manually update the textbox
            $(this).val(ui.item.label);
            }
            ,select: function(event, ui){
            event.preventDefault();
            $(this).val(ui.item.label);
            
            var a = $('#g_dependencia_id').val(ui.item.value);
                
                if($("#g_dependencia_label").val() == 'OTRO'){
                    
                    $("#g_dependencia_otro").show();
                }else{
                    $("#g_dependencia_otro").val('');
                    $("#g_dependencia_otro").hide();
                }
            }
        });
    });
*/

 /*$.getJSON("universidad.php", function (data) {
        $("#g_universidad_label").autocomplete({
            source: data
            ,focus: function(event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
            // manually update the textbox
            $(this).val(ui.item.label);
            }
            ,select: function(event, ui){
            event.preventDefault();
            $(this).val(ui.item.label);
            
            var a = $('#g_universidad_id').val(ui.item.value);
            
                if($("#g_universidad_label").val() == 'OTRO'){
                    
                    $("#g_universidad_otro").show();
                }else{
                    $("#g_universidad_otro").val('');
                    $("#g_universidad_otro").hide();
                }
            }
        });
    });
*/
 /*$.getJSON("universidad.php", function (data) {
        $("#g_inst_prop_label").autocomplete({
            source: data
            ,focus: function(event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
            // manually update the textbox
            $(this).val(ui.item.label);
            }
            ,select: function(event, ui){
            event.preventDefault();
            $(this).val(ui.item.label);
            
            var a = $('#g_inst_prop_id').val(ui.item.value);
            //console.debug(a.val());

                //console.debug($("#g_inst_prop_label").val());
                if($("#g_inst_prop_label").val() == 'OTRO'){
                    
                    $("#g_inst_prop_otro").show();
                }else{
                    $("#g_inst_prop_otro").val('');
                    $("#g_inst_prop_otro").hide();
                }
            }
        });
    });
*/


 $.getJSON("titulo.php", function (data) {
        $("#g_titulo_label").autocomplete({
            source: data
            ,focus: function(event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
            // manually update the textbox
            $(this).val(ui.item.label);
            }
            ,select: function(event, ui){
            event.preventDefault();
            $(this).val(ui.item.label);
            
            var a = $('#g_titulo_id').val(ui.item.value);
                
               if($("#g_titulo_label").val() == 'OTRO'){
                    
                    $("#g_titulo_otro").show();
                }else{

                    $("#g_titulo_otro").val('');
                    $("#g_titulo_otro").hide();
                }
            }
        });
    });

/*
 $.getJSON("facultad.php", function (data) {
        $("#g_facultad_label").autocomplete({
            source: data
            ,focus: function(event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
            // manually update the textbox
            $(this).val(ui.item.label);
            }
            ,select: function(event, ui){
            event.preventDefault();
            $(this).val(ui.item.label);
            
            var a = $('#g_facultad_id').val(ui.item.value);
              
               if($("#g_facultad_label").val() == 'OTRO'){
                    
                    $("#g_facultad_otro").show();
                }else{
                    $("#g_facultad_otro").val('');
                    $("#g_facultad_otro").hide();
                }      
            }
        });
    });
*/

 $.getJSON("actividad.php", function (data) {
        $("#g_actividad_label").autocomplete({
            source: data
            ,focus: function(event, ui) {
            // prevent autocomplete from updating the textbox
            event.preventDefault();
            // manually update the textbox
            $(this).val(ui.item.label);
            }
            ,select: function(event, ui){
            event.preventDefault();
            $(this).val(ui.item.label);
            
            var a = $('#g_actividad_id').val(ui.item.value);
            //console.debug(a.val());
                if($("#g_actividad_label").val() == 'OTRO'){
                    
                    $("#g_actividad_otro").show();
                }else{
                    $("#g_actividad_otro").val('');
                    $("#g_actividad_otro").hide();
                }
            }
        });
    });



// Fechas 
$('#g_f_ingreso_caba').datepicker({
            dateFormat:"yy-mm-dd",  
            yearRange: "-20:+0",
            changeMonth: true,
            changeYear: true
        });

$('#b_fec_nac').datepicker({
            dateFormat:"yy-mm-dd",  
            yearRange: "-80:+0",
            changeMonth: true,
            changeYear: true
        });
$('#g_f_inicio_b').datepicker({dateFormat:"yy-mm-dd"});
$('#g_f_final_b').datepicker({dateFormat:"yy-mm-dd"});



(function fecha_mes(){
var select = $('.b_fecha_m');
console.debug(select);
var mes = {"1":"Enero","2":"Febrero","3":"Marzo","4":"Abril","5":"Mayo","6":"Junio","7":"Julio","8":"Agosto","9":"Septiembre","10":"Octubre","11":"Noviembre","12":"Diciembre"};
//"0":"-",
for (var i = 0; i < select.length; i++) {
      //Insert option
      for (j in mes){
            var option = document.createElement('option');
            var texto = document.createTextNode(mes[j]);
            option.value = j;            
            option.appendChild(texto);
            select[i].appendChild(option);
       } 
};

})();

(function b_fecha_a(){

var select = $('.b_fecha_a');

var anios = Array();
var currentYear = new Date().getFullYear();
var back = 20;

for(var i = 0; i < back;i++){
anios.push(currentYear);
currentYear--;
}

for (var i = 0; i < select.length; i++) {
      //Insert option
      for (var j = 0; j < anios.length; j++){
            var option = document.createElement('option');
            var texto = document.createTextNode(anios[j]);
            option.value = anios[j];            
            option.appendChild(texto);
            select[i].appendChild(option);
       } 
};

})();


(function b_fecha_d(){

var select = $('.b_fecha_d');

var anios = Array();
var currentYear = new Date().getFullYear();
var span = 5;

for(var i = 0; i < span;i++){
anios.push(currentYear);
currentYear++;
}

for (var i = 0; i < select.length; i++) {
      //Insert option
      for (var j = 0; j < anios.length; j++){
            var option = document.createElement('option');
            var texto = document.createTextNode(anios[j]);
            option.value = anios[j];            
            option.appendChild(texto);
            select[i].appendChild(option);
       } 
};

})();



   

//Completo el select de cargo
 $.getJSON("cargo.php", function (data) {
        //console.debug('completo cargo');
        var b_cargo = document.getElementById('b_cargo');
        for(i in data){

            var option = document.createElement('option');
            var texto = document.createTextNode(data[i].label);
            option.value = data[i].value;            
            option.appendChild(texto);
            b_cargo.appendChild(option);   
            //console.debug(data); 
        }
    });

//Completo el select de universidad
$.getJSON("universidad.php", function (data) {
        
        var b_universidad = document.getElementById('b_universidad_id');
        
        for(i in data){

            var option = document.createElement('option');
            var texto = document.createTextNode(data[i].label);
            option.value = data[i].value;            
            option.appendChild(texto);
            b_universidad.appendChild(option);   
        }
    });

//Completo el select de titulo
$.getJSON("titulo.php", function (data) {
        
        var b_titulo = document.getElementById('b_titulo_id');
        
        for(i in data){

            var option = document.createElement('option');
            var texto = document.createTextNode(data[i].label);
            option.value = data[i].value;            
            option.appendChild(texto);
            b_titulo.appendChild(option);   
        }
    });

//Completo el select de facultad
$.getJSON("facultad.php", function (data) {
        
        var b_facultad = document.getElementById('b_facultad_id');
        
        for(i in data){

            var option = document.createElement('option');
            var texto = document.createTextNode(data[i].label);
            option.value = data[i].value;            
            option.appendChild(texto);
            b_facultad.appendChild(option);   
            
        }
    });

$('#b_fuero_id').change(function(e){
//console.debug(e.target.value);
    $("#b_dependencia_id").select2("val", "");


        $.ajax({
          dataType: "json",
          url: "dependencia.php",
          data: {'fuero_id' : e.target.value},
          success: function(data){

            var b_dependencia = document.getElementById('b_dependencia_id');
                b_dependencia.innerHTML = '';

            var option_null = document.createElement('option');
            var texto_null = document.createTextNode('-');
            option_null.selected = true;
            option_null.value = '0';            
            option_null.appendChild(texto_null);
            b_dependencia.appendChild(option_null);      
                
            var option_otro = document.createElement('option');
                var texto_otro = document.createTextNode('OTRO');
                option_otro.value = '-1';            
                option_otro.appendChild(texto_otro);
                b_dependencia.appendChild(option_otro);       

            for(i in data){
            //console.debug(data[i]);    
                var option = document.createElement('option');
                var texto = document.createTextNode(data[i].label);
                option.value = data[i].value;            
                option.appendChild(texto);
                b_dependencia.appendChild(option);   
            }
          }
        });
    /*$.getJSON("dependencia.php", function (data) {
            
            var b_dependencia = document.getElementById('b_dependencia_id');
            
            for(i in data){

                var option = document.createElement('option');
                var texto = document.createTextNode(data[i].label);
                option.value = data[i].value;            
                option.appendChild(texto);
                b_dependencia.appendChild(option);   
                
        }
    });*/

});
/*
$.getJSON("dependencia.php", function (data) {
        
        var b_dependencia = document.getElementById('b_dependencia_id');
        
        for(i in data){

            var option = document.createElement('option');
            var texto = document.createTextNode(data[i].label);
            option.value = data[i].value;            
            option.appendChild(texto);
            b_dependencia.appendChild(option);   
            
        }
});
*/
$("#b_universidad_id").change(function(e){

    if(this.value == -1){
        $("#b_universidad_otro_label").show();
        $("#b_universidad_otro").show();
    }else{
        $("#b_universidad_otro_label").hide();
        $("#b_universidad_otro").hide();
        $("#b_universidad_otro").val('');
    }
});

$("#b_facultad_id").change(function(e){

    if(this.value == -1){
        $("#b_facultad_otro_label").show();
        $("#b_facultad_otro").show();
    }else{
        $("#b_facultad_otro_label").hide();
        $("#b_facultad_otro").hide();
        $("#b_facultad_otro").val('');
    }
});

$("#b_cargo").change(function(e){

    if(this.value == -1){
        $("#b_cargo_otro_label").show();
        $("#b_cargo_otro").show();
    }else{
        $("#b_cargo_otro_label").hide();
        $("#b_cargo_otro").hide();
    }
});

$("#b_dependencia_id").change(function(e){

    if(this.value == -1){
        $("#b_dependencia_otro_label").show();
        $("#b_dependencia_otro").show();
    }else{
        $("#b_dependencia_otro_label").hide();
        $("#b_dependencia_otro").hide();
        $("#b_dependencia_otro").val('');
    }
});

$("#b_titulo_id").change(function(e){

    if(this.value == -1){
        $("#b_titulo_otro_label").show();
        $("#b_titulo_otro").show();
    }else{
        $("#b_titulo_otro_label").hide();
        $("#b_titulo_otro").hide();
        $("#b_titulo_otro").val('');
    }
});


$(".select2").select2({width:"element"});

});





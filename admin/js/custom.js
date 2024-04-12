// $("#cashplus_bank_account_form").submit(function(e) {

//   e.preventDefault();
  
//   let form = $(this);
//   let domain = window.location.hostname;
//   let protocol = window.location.protocol;
  
//   $.ajax({
//       type: "POST",
//       url: protocol+"//"+domain+"/wp-content/plugins/cashplus/elementor-form-post.php",
//       data: form.serialize(), 
//       success: function(data)
//       {
//         alert(data); 
//       }
//   });
  
// });
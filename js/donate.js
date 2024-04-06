const curr = {

    USD: "$", 
    NGN : "₦",
    GHS : "₵",
}


function displaySnack(text){
  Snackbar.show({text: text,
    pos:"bottom-center",
    backgroundColor: '#022b06',
showAction:false});
}


let submitButton = document.getElementById("donate-now");
let msgBox = document.getElementById("stmsg");



async function verifyTransaction(data){

  submitButton.disabled = true; 
  submitButton.classList.add("v");


  try{

    let request = await fetch("/pay.php" , {
      method: "POST",
      body : data
    })


    if(request.status != 200) throw `HTTP error: ${request.status}`;

      let response = await request.json()

      

      if(response){

        msgBox.innerHTML = "Thank you for you generouse donation !";
        msgBox.classList.remove("warn");
        msgBox.scrollIntoView({block : "center", 
        inline : "center", 
        behavior : "smooth"})

      }else { 
        msgBox.classList.add("warn")
        msgBox.innerHTML = `We were unable to verify your donation. 
        If you think this is a mistake please contact info@mics.edu.gh to verify your donation.`
        msgBox.scrollIntoView({block : "center", 
        inline : "center", 
        behavior : "smooth"})

      }


  




  }
  catch(e){

    console.log(e)
    msgBox.classList.add("warn");
    msgBox.innerHTML =`Something went wrong while trying to verify you transaction. This could
    be a connection error or something else , you can contact <a href="mailto:info@mics.edu.gh">info@mics.edu.gh</a>
    to verify your donation.`

    msgBox.scrollIntoView({block : "center", 
    inline : "center", 
    behavior : "smooth"})

  }
  submitButton.disabled = false; 
  submitButton.classList.remove("v");
  
}







document.getElementById("amt-inp").addEventListener("change", function(e){

    document.getElementById("amt").innerHTML = e.target.value

})

document.getElementById("ccy-slct").addEventListener("change", function(e){

    document.getElementById("ccy").innerHTML = curr[e.target.value]
})


//get form 



document.getElementById("paynow").addEventListener("submit",async function(e){

  e.preventDefault();
  let data = new FormData(e.target)

  submitButton.disabled = true ;


  let payHandler = PaystackPop.setup({
    key: 'pk_live_a0a33d31a20cc14470227b283d1f56900c72fa80', 

    channels : [data.get("method")],

    currency : data.get("currency"),

    email: data.get('email'),

    label : data.get("full-name"),

    amount: data.get("amt") * 100,
    
    onClose: function(){
      let close = confirm("Are you sure you want to cancel this transaction")
      if(!close) payHandler.openIframe();
    },
    callback:  function(response){

      //close payHandler 
      data.append("ref",response.reference);

      verifyTransaction(data)
     
    }
  });


  let captcha = grecaptcha.getResponse()


  try{

    if(!captcha)   throw "no-captcha";


      
      //verify captcha     
      

      
    let request = await fetch(`/captcha.php?captcha=${captcha}` , {
      method: "GET"
    })


    if(request.status == 200){

      let response = await request.json()

      console.log(response)
      
      if(!response) throw "Captcha failed";


      payHandler.openIframe();

    }else{
     
      throw `HTTP error: ${request.status}`;
    }


            
      
    
    
    
  

  }
  catch(e){
    console.log(e);
    if(e == "no-captcha"){
      displaySnack("Please complete recaptcha")
      document.getElementById("gcpa").scrollIntoView();
    }
    else{

    
      displaySnack("Recaptcha failed . Please refresh page and try again")

    }

    submitButton.disabled = false;
  }



  submitButton.disabled = false;
    


})








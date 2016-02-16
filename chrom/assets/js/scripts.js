
jQuery(document).ready(function() {

    /*
     * 
     * 
     * 
        Background slideshow
    */
    $.backstretch([

        "assets/img/backgrounds/1.jpg"
                , "assets/img/backgrounds/2.jpg"
                , "assets/img/backgrounds/3.jpg"

    ], {duration: 3000, fade: 750});

    /*
        Tooltips
    */
    $('.links a.home').tooltip();
    $('.links a.adduser').tooltip();
    $('.links a.search').tooltip();
    $('.links a.plugin').tooltip();
    $('.links a.plan').tooltip();
    $('.links a.statistics').tooltip();
    $('.links a.info').tooltip();
    $('.links a.exit').tooltip();

    /*
        Form validation
    */
    $('.register form').submit(function(){
        $(this).find("label[for='firstname']").html('First Name');
        $(this).find("label[for='lastname']").html('Last Name');
        $(this).find("label[for='username']").html('Username');
        $(this).find("label[for='email']").html('Email');
        $(this).find("label[for='password']").html('Password');
        $(this).find("label[for='database_host']").html('Database Host');
        $(this).find("label[for='database_name']").html('Database Name');
        $(this).find("label[for='database_username']").html('Database Username');
        $(this).find("label[for='database_password']").html('Database Password');
        $(this).find("label[for='site_username']").html('Site Username');
        $(this).find("label[for='site_password']").html('Site Password')
        ////
        var firstname = $(this).find('input#firstname').val();
        var lastname = $(this).find('input#lastname').val();
        var username = $(this).find('input#username').val();
        var email = $(this).find('input#email').val();
        var password = $(this).find('input#password').val();
        
        
        /*DATABASE INSTALL*/
         var database_host = $(this).find('input#database_host').val();
         var database_name = $(this).find('input#database_name').val();
         var database_username = $(this).find('input#database_username').val();
         var database_password = $(this).find('input#database_password').val();
          var site_username = $(this).find('input#site_username').val();
         var site_password = $(this).find('input#site_password').val();
         if(database_host==''){
             $(this).find("label[for='database_host']").append("<span style='display:none' class='red'> - Please enter your Database Host.</span>");
            $(this).find("label[for='database_host'] span").fadeIn('medium');
            return false;
         }
           if(database_name==''){
             $(this).find("label[for='database_name']").append("<span style='display:none' class='red'> - Please enter your Database Name.</span>");
            $(this).find("label[for='database_name'] span").fadeIn('medium');
            return false;
         }
               if(database_username==''){
             $(this).find("label[for='database_username']").append("<span style='display:none' class='red'> - Please enter your Database Username.</span>");
            $(this).find("label[for='database_username'] span").fadeIn('medium');
            return false;
         }
//                 if(database_password==''){
//             $(this).find("label[for='database_password']").append("<span style='display:none' class='red'> - Please enter your Database Password.</span>");
//            $(this).find("label[for='database_password'] span").fadeIn('medium');
//            return false;
//         }
                        if(site_username==''){
             $(this).find("label[for='site_username']").append("<span style='display:none' class='red'> - Please enter your Site Username.</span>");
            $(this).find("label[for='site_username'] span").fadeIn('medium');
            return false;
         }
        if(site_password==''){
             $(this).find("label[for='site_password']").append("<span style='display:none' class='red'> - Please enter your Site Password.</span>");
            $(this).find("label[for='site_password'] span").fadeIn('medium');
            return false;
         }
        if(firstname == '') {
            $(this).find("label[for='firstname']").append("<span style='display:none' class='red'> - Please enter your first name.</span>");
            $(this).find("label[for='firstname'] span").fadeIn('medium');
            return false;
        }
        if(lastname == '') {
            $(this).find("label[for='lastname']").append("<span style='display:none' class='red'> - Please enter your last name.</span>");
            $(this).find("label[for='lastname'] span").fadeIn('medium');
            return false;
        }
        if(username == '') {
            $(this).find("label[for='username']").append("<span style='display:none' class='red'> - Please enter a valid username.</span>");
            $(this).find("label[for='username'] span").fadeIn('medium');
            return false;
        }
        if(email == '') {
            $(this).find("label[for='email']").append("<span style='display:none' class='red'> - Please enter a valid email.</span>");
            $(this).find("label[for='email'] span").fadeIn('medium');
            return false;
        }
        if(password == '') {
            $(this).find("label[for='password']").append("<span style='display:none' class='red'> - Please enter a valid password.</span>");
            $(this).find("label[for='password'] span").fadeIn('medium');
            return false;
        }
    });


});



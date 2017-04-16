var UserController=function(response) 
{
    this.login=function() 
    {
        response.render("user_login")
    }
    this.reg=function() 
    {
        response.render("user_reg")
    }
    
}

exports.Controller=UserController;
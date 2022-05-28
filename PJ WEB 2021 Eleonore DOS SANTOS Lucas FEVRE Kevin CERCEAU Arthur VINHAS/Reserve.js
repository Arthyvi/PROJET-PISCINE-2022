function Reserver($coordonee) {

    //alert($coordonee);
    Color = document.getElementById($coordonee).style.backgroundColor;

    if( Color  == "rgb(113, 113, 241)")
    {
        document.getElementById($coordonee).setAttribute('style', 'background-color: green;');
    }
    else
    {
        if(Color != "grey")
        {
            document.getElementById($coordonee).setAttribute('style', 'background-color: rgb(113, 113, 241);');
        }
    }

}



function AccepterRDV($IdClient,$IdDoc)
{   
    for (let i = 1; i<7; i++) 
    {
        for (let j = 1; j<10; j++) 
        {
            if(document.getElementById(j+"-"+i).style.backgroundColor == "rgb(113, 113, 241)")
            {
                $.get("AjouterRDVdansBDD.php",{ClientID: $IdClient ,MedecinID: $IdDoc, Jour : i, Heure : j} ,function(data) {
                
                
                });
                
            }
            
        }
    }

}
window.onload = () => {
    // On va chercher la région
    let region = document.querySelector("#select_dren");
    let cisco = document.querySelector("#select_ciscos");
   // console.log("region == "+region.innerHTML);
  //  console.log("cisco == "+cisco.innerHTML);

/** *********************************************************** */
    if(region){
    region.addEventListener("change", function(){
        let form = this.closest("form");
        let data = this.name + "=" + this.value;
            console.log("Data DREN == ",data);
        fetch(form.action, {
            method: form.getAttribute("method"),
            body: data,
            headers: {
                "Content-Type": "application/x-www-form-urlencoded; charset:UTF-8"
            }
        })
        
        .then(response => response.text())
        .then(html => {
            let content = document.createElement("html");
            content.innerHTML = html;
          //  console.log(html);
            let nouveauSelect = content.querySelector("#select_ciscos");
           // console.log(nouveauSelect);
            document.querySelector("#select_ciscos").replaceWith(nouveauSelect);
            console.log("select_ciscos modifié en...NouveauSelect== ",nouveauSelect);
            // On va chercher les cisco puis les communes => les Zap => Fokontany => village...
            let cisco = nouveauSelect;
            cisco.querySelector("#select_communes_ciscos");
           // console.log("Dernier CISCO== ",cisco);
           cisco.addEventListener("change", function(){
            let form = this.closest("form");
            let dataC = this.name + "=" + this.value;
                console.log("Data CISCO == ",dataC);
            fetch(form.action, {
                method: form.getAttribute("method"),
                body: dataC,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset:UTF-8"
                }
            })
            .then(response => response.text())
            .then(html => {
                let content = document.createElement("html");
                content.innerHTML = html;
              //  console.log(html);
                let nouveauSelect = content.querySelector("#select_commune_ciscos");
               // console.log(nouveauSelect);
                document.querySelector("#select_commune_ciscos").replaceWith(nouveauSelect);
                console.log("select_commune_ciscos modifié en...NouveauSelect== ",nouveauSelect);
            })
            .catch(error => {
                console.log(error);
            })
        });
        })
        .catch(error => {
            console.log(error);
        })
    })
    }
    else if (cisco) {
        region.addEventListener("change", function () {
            let form = this.closest("form");
            let data = this.name + "=" + this.value;
            console.log("Data CISCO == ", data);
            fetch(form.action, {
                method: form.getAttribute("method"),
                body: data,
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset:UTF-8"
                }
            })

                .then(response => response.text())
                .then(html => {
                    let content = document.createElement("html");
                    content.innerHTML = html;
                    //  console.log(html);
                    let nouveauSelect = content.querySelector("#select_commune");
                    // console.log(nouveauSelect);
                    document.querySelector("#select_commune").replaceWith(nouveauSelect);
                    console.log("select_commune modifié en...NouveauSelect== ", nouveauSelect);
                    // On va chercher les cisco puis les communes => les Zap => Fokontany => village...
                    let cisco = nouveauSelect;
                    cisco.querySelector("#select_commune_communes");
                    // console.log("Dernier CISCO== ",cisco);
                    cisco.addEventListener("change", function () {
                        let form = this.closest("form");
                        let dataC = this.name + "=" + this.value;
                        console.log("Data Commune == ", dataC);
                        fetch(form.action, {
                            method: form.getAttribute("method"),
                            body: dataC,
                            headers: {
                                "Content-Type": "application/x-www-form-urlencoded; charset:UTF-8"
                            }
                        })
                            .then(response => response.text())
                            .then(html => {
                                let content = document.createElement("html");
                                content.innerHTML = html;
                                //  console.log(html);
                                let nouveauSelect = content.querySelector("#select_commune_communes");
                                // console.log(nouveauSelect);
                                document.querySelector("#select_commune_communes").replaceWith(nouveauSelect);
                                console.log("select_commune_communes modifié en...NouveauSelect== ", nouveauSelect);
                            })
                            .catch(error => {
                                console.log(error);
                            })
                    });
                })
                .catch(error => {
                    console.log(error);
                })
        })
    }
      ;
    /***************************************************************** */
    
         
}
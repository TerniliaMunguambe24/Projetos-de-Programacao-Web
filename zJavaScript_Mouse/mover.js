var tag=document.querySelector("h1")
tag.onclick=alterarTitulo

var tagImg=document.querySelector("img")
tagImg.onmousedown=alterarConteudo

function alterarConteudo(){
    var tagH1=document.querySelector("h1")
    var tagP=document.querySelector("p")

    var x=event.offsetX
    var y=event.offsetY
    console.log("x: ",x, "Y: ", y)

    if((x>=0 && x<100) &&(y>0 && y<100)){
        tagH1.textContent="Monitor"
        tagP.textContent="O monitor Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis dolore, error, omnis eaque voluptatem illo quasi sint quia est molestiae, consectetur accusamus! Veniam, voluptates eveniet. Odit eligendi inventore beatae illo" 
    }else if ((x>=0 && x<150) &&(y>100 && y<150)){
        tagH1.textContent="Gabinete"
        tagP.textContent="O gabinete Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facilis dolore, error, omnis eaque voluptatem illo quasi sint quia est molestiae, consectetur accusamus! Veniam, voluptates eveniet. Odit eligendi inventore beatae illo" 
    } else {
                tagH1.textContent = "";
                tagP.textContent = "Clique em outra parte da imagem.";
            }
}
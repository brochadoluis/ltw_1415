var counter = 2;
function addInput(){ 
  var newdiv = document.createElement('div');
  newdiv.innerHTML+='<b>Answer number '+ (counter + 1) +': </b><input id=answer'+(counter+1)+' name=Answer'+(counter+1)+' class=answer_type'+' type=text maxlength=60 style= width:150px; border:1px solid #999999; />';
    newdiv.setAttribute("id", "ans");
  document.getElementById('ans').appendChild(newdiv);
  counter++;
}

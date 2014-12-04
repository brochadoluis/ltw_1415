var counter = 2;
function addInput()
{ 
  var newdiv = document.createElement('div');
  newdiv.innerHTML+='<div id=ans><b>Answer number '+ (counter + 1) +':</b><input id=Answer'+(counter+1)+' name=Answer'+(counter+1)+' type=text maxlength=60 style= width:150px; border:1px solid #999999; /></div>';
  document.getElementById('ans').appendChild(newdiv);
  counter++;
}

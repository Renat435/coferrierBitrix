
; /* Start:"a:4:{s:4:"full";s:80:"/local/components/custom/profile/templates/.default/script.min.js?16863397821101";s:6:"source";s:61:"/local/components/custom/profile/templates/.default/script.js";s:3:"min";s:0:"";s:3:"map";s:0:"";}"*/
BX.ready(function(){const b=document.getElementById("profile-change-btn");const c=document.getElementById("change-profile-form");const f=new FormData(c);const e=Object.fromEntries(f);let avatarChanged=false;const d=document.getElementById("profile-change-avatar-input");const a=document.getElementById("preview-avatar");d.addEventListener("change",function(j){avatarChanged=true;b.disabled=false;const h=j.target.files[0];if(h){const g=new FileReader();g.addEventListener("load",function(){a.src=g.result});g.readAsDataURL(h)}});c.addEventListener("input",function(){const g=new FormData(c);const h=Object.fromEntries(g);if(JSON.stringify(e)===JSON.stringify(h)&&!avatarChanged){b.disabled=true}else{b.disabled=false}});b.addEventListener("click",function(){let keys=Object.keys(e);const g=new FormData(c);const h=Object.fromEntries(g);let changeableFields={};for(let i=0;i<keys.length;i++){let currentKey=keys[i];if(e[currentKey]!==h[currentKey]){changeableFields[currentKey.toUpperCase()]=h[currentKey]}}if(avatarChanged){changeableFields.PERSONAL_PHOTO=d.files[0]}console.log(changeableFields)})});
/* End */
;; /* /local/components/custom/profile/templates/.default/script.min.js?16863397821101*/
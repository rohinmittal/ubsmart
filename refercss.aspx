<%@ Page Language="C#" AutoEventWireup="true" CodeFile="login.aspx.cs" Inherits="Default3"  MaintainScrollPositionOnPostback="true"%>

<%@ Register assembly="AjaxControlToolkit" namespace="AjaxControlToolkit" tagprefix="cc1" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>Untitled Page</title>
    <script type = "text/javascript" >
       function preventBack(){window.history.forward();}
        setTimeout("preventBack()", 10);
        window.onunload=function(){null};
    </script>
    </head>
<body style="background-image: url('bgin.png');background-repeat:repeat; z-index:-100" >
  <form id="Form" runat="server">
<div style="margin:-80px auto auto auto;width:800px">
   <div class="header">
   <div style="position:relative; top:100px;" >
    <span >
    <img src='logoin.png' alt="BandLogo" />
   </span>
     <span style="float:right; position:relative;top:10px;right:5px;">
         <asp:LinkButton CssClass="acc" ID="acc" runat="server" Font-Size=Medium onclick="acc_Click"></asp:LinkButton><br />
         
     </span>
    </div>
    </div> 
<div class="menu" style="position:relative;top:100px;"> 
    <asp:LinkButton CssClass="men" ID="but1" runat="server" Height="36px" Width="159px" PostBackUrl="Default2.aspx">HOME</asp:LinkButton>
    <asp:LinkButton CssClass="men" ID="but2" runat="server" Height="36px" Width="159px" PostBackUrl="Tours.aspx">TOURS</asp:LinkButton>
    <asp:LinkButton CssClass="men" ID="but3" runat="server" Height="36px" Width="159px" PostBackUrl="login.aspx" >E-STORE</asp:LinkButton>
    <asp:LinkButton CssClass="men" ID="but4" runat="server" Width="159px" Height="36px" PostBackUrl="News.aspx">NEWS</asp:LinkButton>
    <asp:LinkButton CssClass="men" ID="but5" runat="server" Width="159px" Height="36px" PostBackUrl="Video.aspx">VIDEOS</asp:LinkButton>

 </div>   
 <div class="pgswf" style="height:347px; background-color:white;position:relative;top:105px; background-repeat:repeat-y">
 
 
 
 <object width="800" height="347" id="swfabt" style="position:relative" >
	<param name="allowScriptAccess" value="sameDomain" />
	<param name="allowFullScreen" value="false" />
	<param name="movie" value="abt.swf" /><param name="quality" value="high" />
	<param name="bgcolor" value="#ffffff" />
	    <param name="wmode" value="transparent" /> 
	<embed src="abt.swf" quality="high" bgcolor="#ada577" width="800" height="347" name="swfabt" align="center" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer" />
	</object>
 </div>
 <div id="blwswf" style="width:800px">
  <div class="leftcol" style="background-image:url('leftbar.jpg');float:left; min-height:680px; width:200px;position:relative;top:105px;">
  <br/>
  <div style="text-align:left; margin-left:45px;color:White; font-family:Tahoma;color:white ;font-size:30px;">E-Store</div>
  <span id="textl" style="position:relative;left:45px;width:200px;">
   
   <span id="content">
       <asp:LinkButton CssClass="categ" ID="wvr" runat="server" onclick="wvr_Click">Albums</asp:LinkButton><br/>
       <asp:LinkButton CssClass="categ" ID="formation" runat="server" 
          onclick="formation_Click">Tees</asp:LinkButton><br/>
                 
        <asp:LinkButton CssClass="categ" ID="LinkButton6" runat="server" 
                    onclick="LinkButton6_Click">Miscellaneous</asp:LinkButton><br/>   
    </span>
   </span>
   
 </div>
 
 <div id="rightcol" style="background-color:#ccc399; color:#312f21; float:right; min-height:680px; width:600px;position:relative;top:105px;">
 
  <div style="background-image:url('linegr.jpg'); position:relative; width:557px; margin:14px auto auto 9px; background-repeat:repeat-x;">
    <br /> 
   </div>
  
   <span id=tag style="position:absolute;top:4px;right:3px">
      <img src=tag.jpg alt=tag />
   </span>
   <div style="background-image:url('linegr2.jpg');color:#447c59 ; min-height:610px; float:right; margin:14px 13px 9px auto; background-repeat:repeat-y;">
   <br />.
   </div>
   <div id="textr" style="width:550px;position:relative;left:20px">
  
 <span id="maintext" style="font-size:14px; font-family:Arial; margin-left:13px;">
   
   <span style="font-size:26px;position:relative;left:-10px"><u>Welcome..Please Sign In
                    </u></span><br/><br/><br/>
                    <table style="width:100%; text-align: center;">
                        <tr>
                                <td colspan="3" style="color: #FF0000">
                                    <asp:Label ID="Label1" runat="server"></asp:Label>
                                </td>
                            
                        </tr>
                        
                    </table>
                    
       <table style="width:100%;">
           <tr>
               <td colspan="2">
                   <span style="font-size:20px">New Customer</span></td>
               <td colspan="2">
                   <span style="font-size:20px">Returning Customer</span></td>
               <td>
                   &nbsp;</td>
           </tr>
           <tr>
               <td colspan="2">
                   <small>By creating an account you will be able to shop,be<br/> upto date on an order status,and keep track of the<br/> orders you have already made</small></td>
                                   
               <td colspan="2">
                  <small> I am a returning customer</small></td>
               <td>
                   &nbsp;</td>
           </tr>
           
           <tr>
               <td>
                   Email ID</td>
               <td>
                   <asp:TextBox ID="TextBox1" runat="server" Width="141px"></asp:TextBox>
                            </td>
               <td>
                   Email ID</td>
               <td>
                   <asp:TextBox ID="TextBox4" runat="server" Width="141px"></asp:TextBox>
                            </td>
           </tr>
           <tr>
               <td>
                   Password</td>
               <td>
                   <asp:TextBox ID="TextBox2" runat="server" TextMode="Password"></asp:TextBox>
                            </td>
               <td>
                   Password</td>
               <td>
                   <asp:TextBox ID="TextBox5" runat="server" TextMode="Password"></asp:TextBox>
                            </td>
           </tr>
           <tr>
               <td>
                   Retype Password</td>
               <td>
                   <asp:TextBox ID="TextBox3" runat="server" TextMode="Password"></asp:TextBox>
                            </td>
               
               <td></td>
               <td>
                  <asp:Button ID="Button2" runat="server" onclick="Button2_Click"  Text="Login" /></td>
               <td>
                   &nbsp;</td>
           </tr>
           <tr>
               <td colspan="2">
                   <asp:CheckBox ID="CheckBox1" runat="server" Text="Wanna join the Fan Club?" />
               </td>
               <td>
                   &nbsp;</td>
               <td>
                   &nbsp;</td>
               <td>
                   &nbsp;</td>
           </tr>
           <tr>
               <td>
                   <asp:Button ID="Button1" runat="server" onclick="Button1_Click" Text="Create Account" />
                       
               </td>
               <td>
                   </td>
               <td>
                   
                            </td>
               <td>
                   &nbsp;</td>
           </tr>
       </table>
       </span>
   </div>
    </div>
    <table style="width:100%;">
            <tr>
                <td style="text-align: center">
                    <asp:Label ID="Label3" runat="server" Text="Label" ></asp:Label>  </td>
              
            </tr>
        </table>
    </div>
    </div>
     
 
  <div style="margin:0px auto auto auto;width:926px">
  <div id="Div1" style=" background-image:url('line.jpg');position:relative;top:98px;color:blue; background-repeat:repeat-x;">
   <br />
  </div>
    </div>
        
    </form>
       
</body>
</html>

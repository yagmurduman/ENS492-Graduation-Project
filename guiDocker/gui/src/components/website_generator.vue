<template>

  <div :style="{'background-image': 'url(' + require('../assets/matrix.jpeg') + ')','width':'100%' ,'height':'100%','display': 'flex','justify-content': 'center','align-items': 'center','opacity': '0.9'}"  v-if="this.start=='false'" >
         <v-btn  style="width: 400px;
                        height: 100px;
                        background: #006400;
                        color: #ffff;
                        font-size: 30px;
                        box-shadow: rgb(0 0 0 / 35%) 0px 5px 15px;
                        font-family: Lucida Console;
                        text-shadow: 2px 2px #000000;
                        opacity: 0.9;}"
                 @click="start_func()"> CREATE WEBSITE
          </v-btn>
  </div>

  <v-container v-else >
   
    <v-row  class="text-center">
     
      <v-col cols="12">
        <v-stepper   non-linear>
        <v-stepper-header>
          <v-stepper-step  
           v-for="(step,i) in Options" 
          :complete="stepComplete(i-1)"
          :color="stepStatus(i-1)"
           :key="i"  :step=i+1>
            {{step.question.text}}
          </v-stepper-step>
          <v-divider></v-divider>
        </v-stepper-header> 

        <v-stepper-content   :step="1" style=" min-height:500px;padding:50px !important;">

          <div v-if="choiceindex=='7' && loading=='true'">
              <v-progress-circular 
              :size="70"
              :width="7" 
              color="primary"

              style="margin-top:50px" indeterminate/>
              

           </div>
           <div v-if="choiceindex=='7' && loading=='false'">
             <h1 style="justify-content: center;margin-top:150px;font-size:40px"> Success!</h1>
           </div>

         

          <div v-if="choiceindex<'4'" class="columns is-multiline"  >
              <div class="column is-one-third" :key="ind" v-for="(o,ind) in Options[index].type"  >
                <input type="button" :value= "o.text" @click="select(o.text)" style="width: 100%;height:100px; display:inline-block;" class="button is-outlined"/> 

              
              </div>
          </div>
          <div v-if="choiceindex=='4'" class="columns is-centered" >
              <div class="mt-5 column is-half"  >
                      <v-slider
                        hint="Im a hint"
                        max="100"
                        min="2"
                        value="content_num"
                        v-model="content_num"
                      ></v-slider>
                      {{content_num}}
              </div>
          </div>
          <div v-if="choiceindex=='5'"  class="columns is-centered"  >
              <div class="mt-5 column is-half " >
                    <v-text-field
                       
                        placeholder="Enter the name of your website"
                        filled
                        rounded
                        dense
                        v-model="website_name"
                      ></v-text-field>

                      <v-select v-if="this.choices[0]=='Company'"
                        :items="country"
                        label="Select the location of your business"
                        dense
                        outlined
                        v-model="selected_country"
                      ></v-select>
                      
                      <div v-if="this.choices[0]=='Company'" >  
                      <input  class=" button is-outlined" type="button" value= "Light" @click="color('Light')" style="width: 50%;height:100px; display:inline-block;background-color: #ffffff; color:#00000" /> 
                      </div>

                      
              </div>
          </div>

          
<div v-if="choiceindex=='6'" >
    <div v-if='this.choices[0]=="News"'>
        <div  class="columns is-multiline" >
        <div class="container">
          <body style="background:#EBEBE8 !important;">

            <nav v-bind:style="{background:this.background_color.hex }" style=" height:100px !important;box-shadow: 0 8px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);" class="navbar navbar-expand-sm ">
            <div class="container-fluid ">
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
                <div class="d-md-flex d-block flex-row mx-md-auto mx-0">
                <ul class="navbar-nav me-auto mb-5 mb-lg-1 " style="">
                    <a class="navbar-brand" v-bind:style="{color:this.title_color.hex , fontFamily:this.font, fontSize:this.font_size_title+ 'px'}" >{{this.website_name}}</a>
                </ul> 
                </div>
            </div>
            </nav>
          <ul v-bind:style="{background:this.second_navbar_color.hex }" style="box-shadow: 0 8px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <div  class="nav justify-content-center">  
              <li class="nav-item">
                <a class="nav-link active" v-bind:style="{color:this.background_color.hex , fontFamily:this.font ,fontSize:this.font_size+ 'px'}"  aria-current="page" >{{this.cat1}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" v-bind:style="{color:this.background_color.hex , fontFamily:this.font ,fontSize:this.font_size+ 'px'}" >{{this.cat2}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" v-bind:style="{color:this.background_color.hex , fontFamily:this.font,fontSize:this.font_size+ 'px'}"  >{{this.cat3}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" v-bind:style="{color:this.background_color.hex , fontFamily:this.font,fontSize:this.font_size+ 'px'}"  >{{this.cat4}}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" v-bind:style="{color:this.background_color.hex , fontFamily:this.font,fontSize:this.font_size+ 'px'}"  >{{this.cat5}}</a>
              </li>
            
            
            </div>
          </ul>
          </body>
        </div>
     </div>
    </div>

     <div v-if='this.choices[0]=="Blog"'>
       <div  class="columns is-multiline" >
        <div class="container">
          <body style="background:#EBEBE8 !important;">
            <header v-bind:style="{background:this.background_color.hex }">
              <a v-bind:style="{fontFamily:this.font,color:this.title_color.hex}" style="font-size:45px;">{{this.website_name}}</a>
              <ul class="nav" >
                <li><a v-bind:style="{fontFamily:this.font,color:this.title_color.hex}" >Home</a></li>
                <li><a v-bind:style="{fontFamily:this.font,color:this.title_color.hex}"> Posts</a></li>
                <li><a v-bind:style="{fontFamily:this.font,color:this.title_color.hex}" >Sign Up</a></li>
                <li><a v-bind:style="{fontFamily:this.font,color:this.title_color.hex}" >Login</a></li>
              </ul>
          </header>
          </body>
        </div>
     </div>
     </div>
     <div style="overflow:scroll;  ">
       <!---title color--->
       <div  class="columns is-3 is-centered">
           <chrome-picker class="mt-5 column is-one-third"
            @input="updateValue"
            :value="colors"
            v-model="title_color"
           ></chrome-picker>

        <!---backround color--->    
           <chrome-picker class="mt-5 column is-one-third"
           @input="updateValueBackround"
           :value="colors"
           v-model="background_color"
           ></chrome-picker>
        <chrome-picker v-if ="this.choices[0]=='News'" class="mt-5 column is-one-third"
           @input="updateValueSecondBackround"
          :value="colors"
           v-model="second_navbar_color"
        ></chrome-picker>
     </div>
      <div v-if ="this.choices[0]=='News'" class="columns">

         <div class="mt-5 column is-half">
         
          <v-slider   
                       label="Title font size:" 
                       class="mt-5 column is-four-quarters"
                        hint="Im a hint"
                        max="50"
                        min="10"
                        value="font_size_title"
                        v-model="font_size_title"
          ></v-slider>
           </div>
        <div class="mt-5 column is-half">

          <v-slider   
                       label="Subheader font size:" 
                       class="mt-5 column is-four-quarters"
                        hint="Im a hint"
                        max="25"
                        min="10"
                        value="font_size"
                        v-model="font_size"
          ></v-slider>
               </div>

       </div>
       
       <div  v-if ="this.choices[0]=='News'" class="columns is-centered"  >
              <div class="mt-5 column is-one-fifth " >
                    <v-text-field
                       
                        placeholder="Enter a subcategory"
                        filled
                        rounded
                        dense
                        v-model="cat1"
                      ></v-text-field>
              </div>
              <div class="mt-5 column is-one-fifth " >
                    <v-text-field
                       
                        placeholder="Enter a subcategory"
                        filled
                        rounded
                        dense
                        v-model="cat2"
                      ></v-text-field>
              </div>
              <div class="mt-5 column is-one-fifth" >
                    <v-text-field
                       
                        placeholder="Enter a subcategory"
                        filled
                        rounded
                        dense
                        v-model="cat3"
                      ></v-text-field>
              </div>
              <div class="mt-5 column is-one-fifth " >
                    <v-text-field
                       
                        placeholder="Enter a subcategory"
                        filled
                        rounded
                        dense
                        v-model="cat4"
                      ></v-text-field>
              </div>
              <div class="mt-5 column is-one-fifth " >
                    <v-text-field
                       
                        placeholder="Enter a subcategory"
                        filled
                        rounded
                        dense
                        v-model="cat5"
                      ></v-text-field>
              </div>
               
      </div>
      <div class="columns is-centered" style="padding-bottom:50px;padding-top:50px;">
              <div  class="button_container" v-if="choiceindex=='6'">
            <v-btn  text @click="back()">Back</v-btn>
            <v-btn    @click="send()" color="success">  Done!</v-btn>
                    </div>

        </div>
        </div>
        </div>
           
        </v-stepper-content >
        <div  class="button_container" v-if="choiceindex!= '4' &&  choiceindex!= '6' &&  choiceindex!= '7'">
            <v-btn  @click="back()">Back</v-btn>
            <v-btn  color="success" @click="next()">Next</v-btn>
        </div>
        <div class="button_container" v-if="index== '4'">
            <v-btn   @click="back()">Back</v-btn>
            <v-btn   @click="changeopt()" color="success">  Continue</v-btn>
        </div>
        
           
      </v-stepper>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { Chrome } from 'vue-color'


import axios from 'axios';
  export default {
    name: 'website_generator',
    components: {
    'chrome-picker': Chrome,
  },

   
    methods: {

      updateValue() {
           this.title_col=this.title_color;
      },
      
       updateValueBackround() {
         this.background_col=this.background_color;
           
      },
      updateValueSecondBackround() {
         this.second_navbar_col=this.second_navbar_color;
           
      },

      stepComplete(step) {
            return this.index > step
      },
      start_func(){
        return this.start='true';

      },
    
      next: function(){
        if(this.index<4){
          if(this.choiceindex<7){
            if(this.choices[0]=="Company")
            {
              if(this.index==0)
              {
                  if(this.choices[1]!="-"){
                    this.Options=this.Options2;
                    this.choiceindex+=5;
                    this.choices[1]="-";
                    this.choices[2]="-";
                    this.choices[3]="-";
                    this.choices[4]="-";

                  }
                  else{
                    console.log(this.choiceindex);
                    this.index+=2;
                    this.choiceindex+=1;
                    this.send();
                  }
              }
            }
            else if(this.choices[this.choiceindex]!="" || this.website_name!=""){
              this.index+=1;
              this.choiceindex+=1;
              
            }
          }
        }
        
        return this.index;
      },
       back: function(){
        if(this.choiceindex==5){
              this.Options=this.Options1;
              if(this.choices[0]=="Company")
              {
                  this.choiceindex=0;
                  this.index=0;
                  this.choices[1]="";
                  this.choices[2]="";
                  this.choices[3]="";
                  this.choices[4]="";
              }
              else{
                    this.choiceindex-=1;
                    this.index=4;
              }
        }

        else if(this.index>0 && this.choiceindex>0){
           this.index-=1;
           this.choiceindex-=1;
        }
      
        else if(this.index==4){
            this.choices[4]==this.content_num;
        }

        return this.index;
        
      },
      select: function(val){
        this.choices[this.choiceindex]=val;
        console.log(this.choices);

      },
      stepStatus(step) {
            return this.index > step ? 'green' : 'blue'
        },
   
       changeopt: function(){
        this.Options=this.Options2;
        if(this.index==4){
            this.choices[4]=this.content_num;
        }
        this.index=0;
        this.choiceindex+=1;
     
        console.log(this.choices);
        return this.Options;

      },
     
       color(t){

        this.theme=t;
      },

      send: function(){ 

        this.choiceindex+=1;
        this.loading='true';
        var data={};
        var url="";
        if(this.choices[3]=="Url format"){
          this.image="False";
        }

        else{
          this.image="True";
        }
        
        if(this.choices[2]=="Scraped Content"){this.choices[2]="scraped_content";}
        else if(this.choices[2]=="Paraphrased Content"){this.choices[2]='paraphrase_content';}
        else if(this.choices[2]=="GPT2 Content"){this.choices[2]='gpt2_content';}

        if(this.choices[0]=="News"){
              
              data={
                      "website_type":this.choices[0],
                      "table_name": this.choices[2],
                      "category":this.choices[1],
                      "picture_save":this.image,
                      "number_sequences":this.content_num,
                      "website_name":this.website_name,
                      "title_col":this.title_col.hex,
                      "navbar":this.background_col.hex,
                      "second_navbar_col":this.second_navbar_col.hex,
                      "title_font_size":this.font_size_title+"px",
                      "navlink_font_size":this.font_size+"px",
                      "cat1":this.cat1,
                      "cat2":this.cat2,
                      "cat3":this.cat3,
                      "cat4":this.cat4,
                      "cat5":this.cat5,
                    };
              url="get-contents-news";
        

          }
          else if(this.choices[0]=="Blog"){
            data={
                      "website_type":this.choices[0],
                      "table_name": this.choices[2],
                      "category":this.choices[1],
                      "picture_save":this.image,
                      "number_sequences":this.content_num,
                      "website_name":this.website_name,
                      "title_col":this.title_col.hex,
                      "navbar":this.background_col.hex,
                    };

            url="get-contents-blog";
          }
          else if(this.choices[0]=="Company"){
            data={
                      "website_type":this.choices[0],
                      "website_name":this.website_name,
                      "country":this.selected_country,
                      "theme":this.theme,
                     
                    };

            url="get-contents-company";
             console.log(this.selected_country);
          }
          console.log(data);
          axios.post('http://34.66.139.63:5000/'+url, data)

          .then((response) => { 
                if(response.status==200){
                  console.log(response);
                  axios( {
                          url: "http://34.66.139.63:5000/download",
                          method: 'GET',
                          responseType: 'blob', // important
                          })
                  .then((response) => { {
                          if(response.status==200){

                                      var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                                      var fileLink = document.createElement('a');
                                      fileLink.href = fileURL;
                                      fileLink.setAttribute('download', 'archive.zip');
                                      document.body.appendChild(fileLink);
                                      fileLink.click();
                                      console.log(response)
                                      
                                      //delete files
                                      axios('http://34.66.139.63:5000/clear')
                                      .then((response) => {
                                            if(response.status==200){
                                              this.loading='false';
                                       }})
                                      .catch(function (error) { console.log(error);});

                          }
                          console.log(response.status)
                      }})
                  .catch(function (error) { console.log(error);});
                }
          })
          .catch(function (error) {console.log(error); });
      },
      
},
   mounted(){
     this.Options=this.Options1;

   },
    data: () => ({
      start:'false',
      colors:'#194d33',
      index:0,
      choiceindex:0,
      choices:["","","","",""],
      loading: 'false',
      font:"Times New Roman",
      template:"",
      content:"",
      model:"",
      image:"",
      content_num:50,
      website_name:"",
      stepindex:"",
      step:1,
      title_col:"#f22fff",
      background_color:"#000000",
      background_col:"#000000",
      navlink_color:"#000000",
      second_navbar_color:"#000000",
      second_navbar_col:"#000000",
      title_color:"#ffffff",
      font_size:"50",
      font_size_title:"25",
      cat1:"",
      cat2:"",
      cat3:"",
      cat4:"",
      cat5:"",
      theme:"",
      selected_country:"",
      country: ['Guatemala', 'Rwanda', 'Macao SAR China', 'Panama', 'Antigua  Barbuda', 'Burkina Faso', 'St. Martin', 'Bahrain', 'Bulgaria', 'El Salvador', 'Belgium', 'San Marino', 'Guernsey', 'Algeria', 'Monaco', 'Slovakia', 'Cambodia', 'Tunisia', 'Sint Maarten', 'Kazakhstan', 'Laos', 'Hong Kong', 'Mongolia', 'Benin', 'Zambia', 'Kenya', 'North Macedonia', 'Chile', 'Vietnam', 'Aland Islands', 'Japan', 'Cook Islands', 'Colombia', 'Moldova', 'St. Pierre  Miquelon', 'Thailand', 'French Guiana', 'Honduras', 'New Caledonia', 'Papua New Guinea', 'Comoros', 'Uruguay', 'Andorra', 'South Korea', 'Congo - Kinshasa', 'Afghanistan', 'Greenland', 'Turkmenistan', 'Israel', 'Czechia', 'Djibouti', 'Bolivia', 'Grenada', 'GU', 'Senegal', 'St. Lucia', 'British Virgin Islands', 'Burundi', 'Poland', 'Canada', 'Albania', 'Bahamas', 'Georgia', 'Russia', 'Portugal', 'Trinidad  Tobago', 'Pakistan', 'Angola', 'Botswana', 'Singapore', 'India', 'Venezuela', 'Egypt', 'Gambia', 'PR', 'Aruba', 'Mexico', 'Seychelles', 'Guadeloupe', 'Cameroon', 'China', 'Sierra Leone', 'Romania', 'Bermuda', 'Italy', 'Barbados', 'Faroe Islands', 'Greece', 'Denmark', 'Maldives', 'Nigeria', 'Germany', 'Nicaragua', 'Nepal', 'Namibia', 'Uganda', 'Malta', 'France', 'Fiji', 'Ecuador', 'Curacao', 'Togo', 'Sri Lanka', 'Cayman Islands', 'Tajikistan', 'Jamaica', 'Saudi Arabia', 'Philippines', 'Sweden', 
'Martinique', 'Mauritania', 'Australia', 'Ireland', 'Mauritius', 'Ethiopia', 'Iran', 'Mayotte', 'Libya', 'Uzbekistan', 'Reunion', 'Ukraine', 'Samoa', 'United Arab Emirates', 'Lithuania', 'Haiti', 'Finland', 'Madagascar', 'Cyprus', 'Austria', 'Tanzania', 'Falkland Islands', 'Peru', 'Armenia', 'Kuwait', 'Palestinian Territories', 'Anguilla', 'United States', 'Hungary', 'Brazil', 'Cote d’Ivoire', 'Azerbaijan', 'Eswatini', 'Morocco', 'Belarus', 'Liechtenstein', 'Turkey', 'MP', 'Suriname', 'Latvia', 'Brunei', 'South Africa', 'Belize', 'Croatia', 'Jordan', 'Spain', 'Luxembourg', 'VI', 'United Kingdom', 'Vanuatu', 'Isle of Man', 'Oman', 'Gibraltar', 'Costa Rica', 'Ghana', 'Switzerland', 'Iceland', 'French Polynesia', 'Iraq', 'Malaysia', 'Mali', 'Estonia', 'New Zealand', 'Serbia', 'Lebanon', 'Norway', 'St. Barthelemy', 'Niue', 'Netherlands', 'Myanmar (Burma)', 'Qatar', 'AS', 'Bosnia  Herzegovina', 'Guinea', 'Slovenia', 'Jersey', 'Montenegro', 'Caribbean Netherlands', 'Paraguay', 'Indonesia', 'Dominican Republic', 'Bangladesh', 'Taiwan', 'Kyrgyzstan', 'Argentina'],

      Options:[],
      Options1:
      [
        {
          question:{text:"Choose a template for your website"}, 
          type: [
                  {text:'News'},
                  {text:'Blog'},
                  {text:'Company'},
                ],
        },
        {
          question:{text:"Choose a content for your website"}, 
          type: [
                  {text:'World'},
                  {text:'Economy'},
                  {text:'Health'},
                  {text:'Entertainment'},
                  {text:'Science'},
                  {text:'Sports'},
                  {text:'Tech'},

                ],
        },
        {
          question:{text:"Choose a model for content"}, 
          type : [
                  {text:'Scraped Content'},
                  {text:'Paraphrased Content'},
                  {text:'GPT2 Content'},
                ],
        },
        {
          question:{text:"Should images be in a folder or in url format?"},     
          type : [
            {text:'Url format'},
            {text:'Downloaded'},
          
          ],
        },
        {
          question:{text:"How many content would you like?"}, 
        },
      ],
     radioGroup:"",
     Options2:[
       {
        
          question:{text:"Name your website"}, 
        
        },
        {
          
          question:{text:"Select a color scheme"}, 
         
        },
        {
        question:{text:"Finished! Generating website ..."}, 
         
        },
     ]
      
      
      
    })
  }
</script>

<style  >

.radio{

  margin: auto;
  margin-top:30px;
  width: 50%;

}
.card{
  margin: auto;
  margin-top:100px;
  width:50%;
  height:500px;
  padding:50px;
}

.v-stepper__header .v-stepper__step {

  width:20%;  
}
.v-stepper__header{

  height:100px  !important;

}

.button_container{
    display: flex;
    align-content: center;
    flex-direction: row;
    justify-content: center;
    margin-bottom:10px;
}
.nav {
  display: flex;
  flex-wrap: wrap;
  padding-left: 0;
  margin-bottom: 0;
  list-style: none;
}

.nav-link {
  display: block;
  padding: 0.5rem 1rem;
  text-decoration: none;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
  
 }


@media (prefers-reduced-motion: reduce) {
  .nav-link {
    transition: none;
  }
}

.nav-link.disabled {
  color: #6c757d;
  pointer-events: none;
  cursor: default;
}

.nav-tabs {
  border-bottom: 1px solid #dee2e6;
}

.nav-tabs .nav-link {
  margin-bottom: -1px;
  border: 1px solid transparent;
  border-top-left-radius: 0.25rem;
  border-top-right-radius: 0.25rem;
}

.nav-tabs .nav-link:hover, .nav-tabs .nav-link:focus {
  border-color: #e9ecef #e9ecef #dee2e6;
}

.nav-tabs .nav-link.disabled {
  color: #6c757d;
  background-color: transparent;
  border-color: transparent;
}

.nav-tabs .nav-link.active,
.nav-tabs .nav-item.show .nav-link {
  color: #495057;
  background-color: #fff;
  border-color: #dee2e6 #dee2e6 #fff;
}

.nav-tabs .dropdown-menu {
  margin-top: -1px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.nav-pills .nav-link {
  border-radius: 0.25rem;
}

.nav-pills .nav-link.active,
.nav-pills .show > .nav-link {
  color: #fff;
  background-color: #0d6efd;
}

.nav-fill > .nav-link,
.nav-fill .nav-item {
  flex: 1 1 auto;
  text-align: center;
}

.nav-justified > .nav-link,
.nav-justified .nav-item {
  flex-basis: 0;
  flex-grow: 1;
  text-align: center;
}

.tab-content > .tab-pane {
  display: none;
}

.tab-content > .active {
  display: block;
}

.navbar {
  position: relative;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  justify-content: space-between;
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.navbar > .container,
.navbar > .container-fluid, .navbar > .container-sm, .navbar > .container-md, .navbar > .container-lg, .navbar > .container-xl, .navbar > .container-xxl {
  display: flex;
  flex-wrap: inherit;
  align-items: center;
  justify-content: space-between;
}

.navbar-brand {
  padding-top: 0.3125rem;
  padding-bottom: 0.3125rem;
  margin-right: 1rem;
  font-size: 1.25rem;
  text-decoration: none;
  white-space: nowrap;
}

.navbar-nav {
  display: flex;
  flex-direction: column;
  padding-left: 0;
  margin-bottom: 0;
  list-style: none;
}

.navbar-nav .nav-link {
  padding-right: 0;
  padding-left: 0;
}

.navbar-nav .dropdown-menu {
  position: static;
}

.navbar-text {
  padding-top: 0.5rem;
  padding-bottom: 0.5rem;
}

.navbar-collapse {
  align-items: center;
  width: 100%;
}

.navbar-toggler {
  padding: 0.25rem 0.75rem;
  font-size: 1.25rem;
  line-height: 1;
  background-color: transparent;
  border: 1px solid transparent;
  border-radius: 0.25rem;
  transition: box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
  .navbar-toggler {
    transition: none;
  }
}

.navbar-toggler:hover {
  text-decoration: none;
}

.navbar-toggler:focus {
  text-decoration: none;
  outline: 0;
  box-shadow: 0 0 0 0.2rem;
}

.navbar-toggler-icon {
  display: inline-block;
  width: 1.5em;
  height: 1.5em;
  vertical-align: middle;
  background-repeat: no-repeat;
  background-position: center;
  background-size: 100%;
}

@media (min-width: 576px) {
  .navbar-expand-sm {
    flex-wrap: nowrap;
    justify-content: flex-start;
  }
  .navbar-expand-sm .navbar-nav {
    flex-direction: row;
  }
  .navbar-expand-sm .navbar-nav .dropdown-menu {
    position: absolute;
  }
  .navbar-expand-sm .navbar-nav .nav-link {
    padding-right: 0.5rem;
    padding-left: 0.5rem;
  }
  .navbar-expand-sm .navbar-collapse {
    display: flex !important;
  }
  .navbar-expand-sm .navbar-toggler {
    display: none;
  }
}

@media (min-width: 768px) {
  .navbar-expand-md {
    flex-wrap: nowrap;
    justify-content: flex-start;
  }
  .navbar-expand-md .navbar-nav {
    flex-direction: row;
  }
  .navbar-expand-md .navbar-nav .dropdown-menu {
    position: absolute;
  }
  .navbar-expand-md .navbar-nav .nav-link {
    padding-right: 0.5rem;
    padding-left: 0.5rem;
  }
  .navbar-expand-md .navbar-collapse {
    display: flex !important;
  }
  .navbar-expand-md .navbar-toggler {
    display: none;
  }
}

@media (min-width: 992px) {
  .navbar-expand-lg {
    flex-wrap: nowrap;
    justify-content: flex-start;
  }
  .navbar-expand-lg .navbar-nav {
    flex-direction: row;
  }
  .navbar-expand-lg .navbar-nav .dropdown-menu {
    position: absolute;
  }
  .navbar-expand-lg .navbar-nav .nav-link {
    padding-right: 0.5rem;
    padding-left: 0.5rem;
  }
  .navbar-expand-lg .navbar-collapse {
    display: flex !important;
  }
  .navbar-expand-lg .navbar-toggler {
    display: none;
  }
}

@media (min-width: 1200px) {
  .navbar-expand-xl {
    flex-wrap: nowrap;
    justify-content: flex-start;
  }
  .navbar-expand-xl .navbar-nav {
    flex-direction: row;
  }
  .navbar-expand-xl .navbar-nav .dropdown-menu {
    position: absolute;
  }
  .navbar-expand-xl .navbar-nav .nav-link {
    padding-right: 0.5rem;
    padding-left: 0.5rem;
  }
  .navbar-expand-xl .navbar-collapse {
    display: flex !important;
  }
  .navbar-expand-xl .navbar-toggler {
    display: none;
  }
}

@media (min-width: 1400px) {
  .navbar-expand-xxl {
    flex-wrap: nowrap;
    justify-content: flex-start;
  }
  .navbar-expand-xxl .navbar-nav {
    flex-direction: row;
  }
  .navbar-expand-xxl .navbar-nav .dropdown-menu {
    position: absolute;
  }
  .navbar-expand-xxl .navbar-nav .nav-link {
    padding-right: 0.5rem;
    padding-left: 0.5rem;
  }
  .navbar-expand-xxl .navbar-collapse {
    display: flex !important;
  }
  .navbar-expand-xxl .navbar-toggler {
    display: none;
  }
}

.navbar-expand {
  flex-wrap: nowrap;
  justify-content: flex-start;
}

.navbar-expand .navbar-nav {
  flex-direction: row;
}

.navbar-expand .navbar-nav .dropdown-menu {
  position: absolute;
}

.navbar-expand .navbar-nav .nav-link {
  padding-right: 0.5rem;
  padding-left: 0.5rem;
}

.navbar-expand .navbar-collapse {
  display: flex !important;
}

.navbar-expand .navbar-toggler {
  display: none;
}

.navbar-light .navbar-brand {
  color: rgba(0, 0, 0, 0.9);
}

.navbar-light .navbar-brand:hover, .navbar-light .navbar-brand:focus {
  color: rgba(0, 0, 0, 0.9);
}

.navbar-light .navbar-nav .nav-link {
  color: rgba(0, 0, 0, 0.55);
}

.navbar-light .navbar-nav .nav-link:hover, .navbar-light .navbar-nav .nav-link:focus {
  color: rgba(0, 0, 0, 0.7);
}

.navbar-light .navbar-nav .nav-link.disabled {
  color: rgba(0, 0, 0, 0.3);
}

.navbar-light .navbar-nav .show > .nav-link,
.navbar-light .navbar-nav .nav-link.active {
  color: rgba(0, 0, 0, 0.9);
}

.navbar-light .navbar-toggler {
  color: rgba(0, 0, 0, 0.55);
  border-color: rgba(0, 0, 0, 0.1);
}

.navbar-light .navbar-toggler-icon {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%280, 0, 0, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

.navbar-light .navbar-text {
  color: rgba(0, 0, 0, 0.55);
}

.navbar-light .navbar-text a,
.navbar-light .navbar-text a:hover,
.navbar-light .navbar-text a:focus {
  color: rgba(0, 0, 0, 0.9);
}

.navbar-dark .navbar-brand {
  color: #fff;
}

.navbar-dark .navbar-brand:hover, .navbar-dark .navbar-brand:focus {
  color: #fff;
}

.navbar-dark .navbar-nav .nav-link {
  color: rgba(255, 255, 255, 0.55);
}

.navbar-dark .navbar-nav .nav-link:hover, .navbar-dark .navbar-nav .nav-link:focus {
  color: rgba(255, 255, 255, 0.75);
}

.navbar-dark .navbar-nav .nav-link.disabled {
  color: rgba(255, 255, 255, 0.25);
}

.navbar-dark .navbar-nav .show > .nav-link,
.navbar-dark .navbar-nav .nav-link.active {
  color: #fff;
}

.navbar-dark .navbar-toggler {
  color: rgba(255, 255, 255, 0.55);
  border-color: rgba(255, 255, 255, 0.1);
}

.navbar-dark .navbar-toggler-icon {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

.navbar-dark .navbar-text {
  color: rgba(255, 255, 255, 0.55);
}

.navbar-dark .navbar-text a,
.navbar-dark .navbar-text a:hover,
.navbar-dark .navbar-text a:focus {
  color: #fff;
}


header {
  background: #364b85;
  height: 66px;
}

header * {
  color: white;
}

header a {
  float: left;
  margin-left:15px;
}


header ul {
  float: right;
  margin: 0px;
  padding: 0px;
  list-style: none;
}

header ul li {
  float: left;
  position: relative;
}

header ul li ul {
  position: absolute;
  top: 66px;
  right: 0px;
  width: 180px;
  display: none;
  z-index: 88888;
}

header ul li:hover ul {
  display: block;
}

header ul li ul li {
  width: 100%;
}

header ul li ul li a {
  padding: 10px;
  background: white;
  color: #444;
}

header ul li ul li a.logout {
  color: red;
}

header ul li ul li a:hover {
  background: #d5d6d6;
}

header ul li a {
  display: block;
  padding: 21px;
  font-size: 1.1em;
  text-decoration: none;
}

header ul li a:hover {
  background: #364b85;
  transition: 0.5s;
}

header .menu-toggle {
  display: none;
}

.page-wrapper {
  min-height: 100%;
}

.page-wrapper a:hover {
  color: #006669;
}

</style>

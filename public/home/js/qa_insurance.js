  /************************** CalcQA ************/
  var CalcQA = document.getElementById('CalcQA');
  function createElm(html, sec)
  {
   var elm = document.createElement('div');
   elm.setAttribute('class', 'form-group ' + sec);
   elm.innerHTML = html;
   CalcQA.appendChild(elm);
  }

  // Would you like a portion of your income to go to spouse?
  function married(e)
  {
     var nextElm = e.parentNode.parentNode.nextElementSibling;
     if(e.value == 'Married' && nextElm == null)
     {  
        let html;      
        html = '<label for="">Would you like a portion of your income to go to spouse?</label><br>'+'<label for=""><input type="radio" name="spouse_receive" value="Yes" onchange="spouseReceive(this)"> Yes &nbsp; </label>'+'<label for=""><input type="radio" name="spouse_receive" value="No" onchange="haveChildren(this);removeSection(\'section_1\');"> No</label>';
        createElm(html, 'section_1');        
     }
  }

  // What is your total annual income?
  // What percentage of your annual income would you like to go to your spouse?
  // For how many years would you like your spouse to continue to receive this income?
  function spouseReceive(e)
  {
     var nextElm = e.parentNode.parentNode.nextElementSibling;
     if(e.value == 'Yes' && nextElm == null)
     {
         let html = '';
         let html2 = '';
         let html3 = '';

        html = '<label for="">What is your total annual income?</label><br>'+'<label for=""><input type="number" class="form-control" name="annual_income" id="annual_income" step="0.01" placeholder="$00.00"></label>';
        createElm(html, 'section_1');
        
        html2 = '<label for="">What percentage of your annual income would you like to go to your spouse?</label><br><label><input type="number" class="form-control" name="spouse_percent" id="spouse_percent" step="0.01" placeholder="0.00%"></label>';
        createElm(html2, 'section_1');
      
        html3 = '<label for="">For how many years would you like your spouse to continue to receive this income?</label><br><label><input type="number" class="form-control" name="year" id="year" step="0.01" placeholder="00"></label>'+
        '<br><button class="btn btn-info" onclick="haveChildren(this);calcSpouseFund(); rmnext(this); removeSection(\'section_1\')">Next</button>';
        createElm(html3, 'section_1');
     }

  }

  /** Do you have children? */
  function haveChildren(e)
  {
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(nextElm == null)
   {
      let html;
      html = '<label for="">Do you have children?</label><br>'+'<label for=""><input type="radio" name="children" value="Yes" onchange="childUnder21(this)"> Yes &nbsp; </label>'+'<label for=""><input type="radio" name="children" value="No" onchange="payingMortgage(this); removeSection(\'section_2\')"> No</label>';
      createElm(html, 'section_2');
   }

  }

  // Are any of your children under the age of 21?
  function childUnder21(e)
  {
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(e.value == 'Yes' && nextElm == null)
   {
      let html;
      html = '<label for="">Are any of your children under the age of 21?</label><br>'+'<label for=""><input type="radio" name="children21" value="Yes" onchange="schoolFund(this)"> Yes &nbsp; </label>'+'<label for=""><input type="radio" name="children21" value="No" onchange="collegeChild(this);"> No</label>';
      createElm(html, 'section_2');
   }
  }

   // Would you provide after school program funds for your children who are under 21 years old?
  function schoolFund(e)
  {
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(e.value == 'Yes' && nextElm == null)
   {
      let html;
      html = '<label for="">Would you provide after school program funds for your children who are under 21 years old?</label><br>'+'<label for=""><input type="radio" name="schoolfund" value="Yes" onchange="howSchoolFund(this)"> Yes &nbsp; </label>'+'<label for=""><input type="radio" name="schoolfund" value="No" onchange="collegeChild(this);"> No</label>';
      createElm(html, 'section_2');
   }
  }

  //How much funds per year would you provide for each child and How many years would you like them to receive the funds?
  function howSchoolFund(e)
  {
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(e.value == 'Yes' && nextElm == null)
   {
      let html;
      html = '<label for="">How much funds per year would you provide for each child and How many years would you like them to receive the funds?</label><br>'+
      '<label for=""><input class="form-control" type="number" name="how_much_fund" id="child21_school_amount" placeholder="How much per year $00.00"></label>'+
      '<label for=""><input class="form-control" type="number" name="how_many_year" id="child21_school_year" placeholder="How many year 0"></label>'+
      '<br><button class="btn btn-info" onclick="collegeChild(this);calcChildSchoolFund(); rmnext(this); removeSection(\'section_2\')">Next</button>';;
      createElm(html, 'section_2');
   }
  }

   //Do you have any children in College or going to start College?
  function collegeChild(e)
  {
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(nextElm == null)
   {
      let html;
      html = '<label for="">Do you have any children in College or going to start College?</label><br>'+'<label for=""><input type="radio" name="college_child" value="Yes" onchange="howManyCollegeChildren(this)"> Yes &nbsp; </label>'+'<label for=""><input type="radio" name="college_child" value="No" onchange="payingMortgage(this)"> No</label>';
      createElm(html, 'section_3');
   }

   if(e.value == 'No')
   {
      removeSection('section_2');
   }
  }

  //How many Children going to College or going to start College?
  function howManyCollegeChildren(e) 
  {
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(e.value == 'Yes' && nextElm == null)
   {
      let html;
      html = '<label for="">How many Children going to College or going to start College?</label><br>'+
      '<label for=""><input class="form-control" type="number" name="how_many_children" id="college_child_number" placeholder="How many children 0"></label>'+
      '<br><button class="btn btn-info" onclick="likeToPay(this); rmnext(this)"">Next</button>';
      createElm(html, 'section_3');
   }
  }

  //Would you like to continue to pay for their Annual College Expenses?
  function likeToPay(e)
  {
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(nextElm == null)
   {
      let html;
      html = '<label for="">Would you like to continue to pay for their Annual College Expenses?</label><br>'+'<label for=""><input type="radio" name="likeToPay" value="Yes" onchange="howMuchPerYear(this)"> Yes &nbsp; </label>'+'<label for=""><input type="radio" name="likeToPay" value="No" onchange="payingMortgage(this); removeSection(\'section_3\')"> No</label>';
      createElm(html, 'section_3');
   }
  }

  //How much per year would you like to contribute towards each College Student Expenses?
  //How Many Years Would like to pay for each College Student Expense?
  function howMuchPerYear(e)
  {
     var nextElm = e.parentNode.parentNode.nextElementSibling;

     if(e.value == 'Yes' && nextElm == null)
     {
         let html = '';
         let html2 = '';

        html = '<label for="">How much per year would you like to contribute towards each College Student Expenses?</label><br>'+'<label for=""><input type="number" class="form-control" name="college_child_expense" id="college_child_expense" step="0.01" placeholder="$00.00"></label>';
        createElm(html, 'section_3');
        
        html2 = '<label for="">How Many Years Would like to pay for each College Student Expense?</label><br><label><input type="number" class="form-control" name="college_child_year" id="college_child_year" step="0.01" placeholder="0"></label>'+
        '<br><button class="btn btn-info" onclick="calcChildCollegeFund(); payingMortgage(this); rmnext(this); removeSection(\'section_3\')">Next</button>';
        createElm(html2, 'section_3');
     }

  }

//Are You Currently Paying a Mortgage?
function payingMortgage(e)
{
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(nextElm == null)
   {
      let html;
      html = '<label for="">Are You Currently Paying a Mortgage?</label><br>'+'<label for=""><input type="radio" name="mortgage" value="Yes" onchange="oweToBank(this)"> Yes &nbsp; </label>'+'<label for=""><input type="radio" name="mortgage" value="No" onchange="rentingHome(this)"> No</label>';
      createElm(html, 'section_4');
   }

   if(e.value == 'No')
   {
      removeSection('section_3');
   }
}
//What is your balance you owed to the Bank?
function oweToBank(e)
{
   let nextElm = e.parentNode.parentNode.nextElementSibling;

   if(e.value == 'Yes' && nextElm == null)
   {
      let html;
      html = '<label for="">What is your balance you owed to the Bank?</label><br>'+'<label for=""><input type="number" class="form-control" id="bank_debt" placeholder="$00.00"></label>'+
      '<br><button class="btn btn-info" onclick="paidInFull(this); rmnext(this)"">Next</button>';
      createElm(html, 'section_4');
   }
}
//Would you like this balance to be paid in full?'
function paidInFull(e)
{
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(nextElm == null)
   {
      let html;
      html = '<label for="">Would you like this balance to be paid in full?</label><br>'+'<label for=""><input type="radio" name="paid_full" value="Yes" onchange="rentingHome(this)"> Yes &nbsp; </label>'+'<label for=""><input type="radio" name="paid_full" value="No" onchange="rentingHome(this)"> No</label>';
      createElm(html, 'section_4');
   }
}

//-----------------
//Are you Renting a home?
function rentingHome(e)
{
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(nextElm == null)
   {
      let html;
      html = '<label for="">Are you Renting a home?</label><br>'+'<label for=""><input type="radio" name="renting_home" value="Yes" onchange="howMuchRent(this)"> Yes &nbsp; </label>'+'<label for=""><input type="radio" name="renting_home" value="No" onchange="haveDebt(this); removeSection(\'section_5\')"> No</label>';
      createElm(html, 'section_5');
   }

   if(e.value == 'Yes')
   {
      let amount = document.getElementById('bank_debt');
      let totalCalc = document.getElementById('totalCalc');
      let totalView = Number(totalCalc.value.replace(/[$,]/g, ""));

      totalCalc.value = usdFormat(totalView + Number(amount.value));
   }


   // remove section
   removeSection('section_4');
}
//How much do you pay monthly for rent? $______
function howMuchRent(e)
{
   let nextElm = e.parentNode.parentNode.nextElementSibling;

   if(e.value == 'Yes' && nextElm == null)
   {
      let html;
      html = '<label for="">How much do you pay monthly for rent?</label><br>'+'<label for=""><input type="number" class="form-control" id="home_rent_amount" placeholder="$00.00"></label>'+
      '<br><button class="btn btn-info" onclick="familyPayRent(this); rmnext(this)"">Next</button>';
      createElm(html, 'section_5');
   }
}
//Would you like your insurance policy to continue to pay the rent for your family?
//Would you like your family to continue to pay the rent for your family?
function familyPayRent(e)
{
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(nextElm == null)
   {
      let html;
      html = '<label for="">Would you like your insurance policy to continue to pay the rent for your family?</label><br>'+'<label for=""><input type="radio" name="family_pay" value="Yes" onchange="howManyYearsFamilyPay(this)"> Yes &nbsp; </label>'+'<label for=""><input type="radio" name="family_pay" value="No" onchange="haveDebt(this); removeSection(\'section_5\')"> No</label>';
      createElm(html, 'section_5');
   }
}
//How many years would you like to cover the rent for your family?
function howManyYearsFamilyPay(e)
{
   let nextElm = e.parentNode.parentNode.nextElementSibling;

   if(e.value == 'Yes' && nextElm == null)
   {
      let html;
      html = '<label for="">How many years would you like to cover the rent for your family?</label><br>'+'<label for=""><input type="number" class="form-control" id="home_rent_pay_year" placeholder="Years 0"></label>'+
      '<br><button class="btn btn-info" onclick="calcHomeRent(); haveDebt(this); rmnext(this); removeSection(\'section_5\')">Next</button>';
      createElm(html, 'section_5');
   }
}
//Do you have any debt that you would like your Insurance to pay off on your behalf?
function haveDebt(e)
{
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(nextElm == null)
   {
      let html;
      html = '<label for="">Do you have any debt that you would like your Insurance to pay off on your behalf?</label><br>'+'<label for=""><input type="radio" name="have_debt" value="Yes" onchange="howMuchDebt(this)"> Yes &nbsp; </label>'+'<label for=""><input type="radio" name="have_debt" value="No" onchange="funeralExpenses(this); removeSection(\'section_6\')"> No</label>';
      createElm(html, 'section_6');
   }
}
//What is your total outstanding debt? _____
function howMuchDebt(e)
{
   let nextElm = e.parentNode.parentNode.nextElementSibling;

   if(e.value == 'Yes' && nextElm == null)
   {
      let html;
      html = '<label for="">What is your total outstanding debt?</label><br>'+'<label for=""><input type="number" class="form-control" id="total_debt" placeholder="$00.00"></label>'+
      '<br><button class="btn btn-info" onclick="calcDebt(); funeralExpenses(this); rmnext(this); removeSection(\'section_6\')">Next</button>';
      createElm(html, 'section_6');
   }
}
//One Last important question for you:
//If for some reason or another, you died this morning and your family needs to prepare for your funeral. How much cash would they need immediately to cover your funeral expenses? $_________
function funeralExpenses(e)
{
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(nextElm == null)
   {
      let html;
      html = '<label for="">If for some reason or another, you died this morning and your family needs to prepare for your funeral. How much cash would they need immediately to cover your funeral expenses?</label><br>'+'<label for=""><input type="number" class="form-control" id="total_funeral" placeholder="$00.00"></label>'+
      '<br><button class="btn btn-info" onclick="calcFuneral(); thankYou(this); rmnext(this); removeSection(\'section_7\')">Next</button>';
      createElm(html, 'section_7');
   }
}

function thankYou(e)
{
   let nextElm = e.parentNode.parentNode.nextElementSibling;
   if(nextElm == null)
   {
      let html;
      html = '<label style="font-size:18px">Thank you for taking the time to share your insurance needs with us! We appreciate your trust in Guardian My Life and our authorized agent partners. Your responses will help us provide personalized guidance and recommendations tailored to your unique situation. We\'ll be in touch soon to discuss your options. Thank you again for choosing Guardian My Life!</label>';
      createElm(html);
   }
}

// remove sections
function removeSection(sec)
{
   let secs = document.getElementsByClassName(sec);
   let length = secs.length;

   setTimeout(function() {

      for(let x = 0; x <= length; x++)
      {
         secs[x].style.display = 'none';
      }

   }, 500);
}
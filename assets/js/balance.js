  	var budgetAmount = parseFloat(document.getElementById('budget').value);
      var expenseAmount = parseFloat(document.getElementById('expense').value);
      var balance = document.getElementById('balance');
      var bal = budgetAmount - expenseAmount;
      bal = bal.toFixed(2);
      balance.value = bal;

      if (budgetAmount < expenseAmount) {
      	document.getElementById("balance").value = "Insufficient Budget";
            document.getElementById("pesoSign").remove();
            document.getElementById("span").remove();
      } 
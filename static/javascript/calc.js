// let data = {
//   May3: 1,
//   May6: 1,
//   May7: 2,
//   May10: 1,
//   May15: 3
// };



let DBResults = [];

DBResults.push({Date: '3', Total: 1});
DBResults.push({Date: '6', Total: 1});
DBResults.push({Date: '7', Total: 2});
DBResults.push({Date: '10', Total: 1});
DBResults.push({Date: '15', Total: 3});

let total = 0;
let plotArray = [];
let PeriodStart = 1;
let PeriodEnd = 18;
for (let i = PeriodStart; i <= PeriodEnd; i++) {
  if (DBResults.length > 0 && DBResults[0].Date == i) {
    total = total + DBResults.shift().Total;
    plotArray.push(total);
  }  
  else {
    plotArray.push(total);
  }
}
console.log(plotArray);
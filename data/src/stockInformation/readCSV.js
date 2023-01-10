const fs = require("fs");
const { parse } = require("csv-parse");
fs.createReadStream("./db_list.csv")
  .pipe(csv())
  .on("data", function (row) {
    console.log(row);
  })
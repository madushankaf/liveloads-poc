const express = require("express");

const app = express();

app.use(express.json());
app.use(express.urlencoded({ extended: true }));


app.post("/shippingNotices", (req, res) => {
  const shippingNotice = req.body;
  console.log(shippingNotice);
  res.status(200).send("Success");
});



app.listen(9090, () => {
  console.log("Server started on port 9090");
});
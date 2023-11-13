const express = require("express");
const axios = require('axios');

const Campaign = Object.freeze({
    id: "",
    createdAt: "",
    Company: "",
    CampaginName: "",
    Advertiser: "",
  });

const app = express();

app.use(express.json());
app.use(express.urlencoded({ extended: true }));


app.post("/shippingNotices", (req, res) => {
  const shippingNotice = req.body;
  console.log(shippingNotice);
});





app.listen(9090, () => {
  console.log("Server started on port 9090");
});
https://docs.google.com/spreadsheets/d/12hzbwMHay8_Q6PTppS5KkoANF6XLjLUI1TyJdnBhtfI/edit#gid=725343107



   // models/User.js
   const mongoose = require('mongoose');
   const Schema = mongoose.Schema;
   const Log = require('./Log');

   const userSchema = new Schema({
     username: String,
     email: String,
     status: Boolean, // Added status field
     // other fields...
   });

   userSchema.pre('updateOne', async function(next) {
     const updatedFields = this.getUpdate();
     const userId = this.getQuery()._id;

     // Check if the 'status' field has been modified
     if ('status' in updatedFields.$set) {
       const newStatus = updatedFields.$set.status;
       const user = await this.model.findOne({ _id: userId });

       if (user.status !== newStatus) {
         const logData = {
           userId: userId,
           action: newStatus ? 'Entry Time' : 'Exit Time',
           // other log data...
         };

         try {
           // Insert into Log collection
           await Log.create(logData);
         } catch (error) {
           console.error(error);
         }
       }
     }

     next();
   });

   module.exports = mongoose.model('User', userSchema);






























   <?php
$uri = urldecode(
    parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
);

// This file allows us to emulate Apache's "mod_rewrite" functionality from the
// built-in PHP web server. This provides a convenient way to test a Laravel
// application without having installed a "real" web server software here.
if ($uri !== '/' && file_exists(__DIR__.'/public'.$uri)) {
    return false;
}

require_once __DIR__.'/public/index.php';

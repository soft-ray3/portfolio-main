# FormSpree Setup Guide

Your portfolio is now configured to use **FormSpree** for email submissions instead of EmailJS. This is simpler and requires no API keys.

## Setup Instructions

### Step 1: Create a FormSpree Account
1. Go to [https://formspree.io](https://formspree.io)
2. Sign up with your email address
3. Verify your email

### Step 2: Create a Form
1. After logging in, click **"New Form"**
2. Give it a name (e.g., "Portfolio Contact Form")
3. FormSpree will generate a **Form ID** (looks like: `myzgndov`)
4. Copy this Form ID

### Step 3: Update Your Code
The default FormSpree ID `myzgndov` is already in the code as a placeholder. You need to replace it with your actual Form ID in two files:

#### File 1: `/asset/js/main.js` (Contact Form)
Find this line:
```javascript
const FORMSPREE_ID = 'myzgndov'; // Replace with your actual FormSpree ID
```
Replace `myzgndov` with your actual FormSpree ID.

#### File 2: `/asset/js/consultation.js` (Consultation Form)
Find this line:
```javascript
const FORMSPREE_ID = 'myzgndov'; // Replace with your actual FormSpree ID
```
Replace `myzgndov` with your actual FormSpree ID.

### Step 4: Verify Email Delivery
After setting up:
1. Go to your FormSpree dashboard
2. Look for your form
3. Check the **"Settings"** tab
4. Make sure your email address is listed as a recipient
5. Emails should be set to forward to `onahraymond18@gmail.com`

## How It Works

When a user submits the contact or consultation form:
1. The form data is sent to `https://formspree.io/f/{YOUR_FORM_ID}`
2. FormSpree receives the data
3. FormSpree sends an email to your configured email address
4. User sees a success message

## Features

✅ No need for EmailJS or API keys  
✅ Built-in spam protection  
✅ File uploads supported  
✅ Email notifications  
✅ Form submissions dashboard  
✅ AJAX/JSON support  
✅ CORS-enabled (works with fetch API)  
✅ Free tier includes unlimited forms  

## Troubleshooting

**Forms not sending?**
- Check console for errors (F12 → Console tab)
- Verify your FormSpree ID is correct
- Make sure you verified your email in FormSpree

**Emails not arriving?**
- Check FormSpree dashboard to see if submission was received
- Check spam/junk folder
- Verify email address in FormSpree settings

**Want to test?**
- Open browser console (F12)
- You'll see "Sending email with FormSpree..." and response status messages
- These help confirm the form is submitting correctly

## Optional: Additional FormSpree Features

You can use FormSpree's dashboard to:
- View all submissions
- Export form data
- Set auto-reply emails
- Customize success/error pages
- Add webhooks for automation

# Ping Receipt

Welcome to the repo for my anonymous [ping](https://ping.aschmelyun.com) site that prints out a receipt on my desk.

If you're coming from [my video]() and would like to explore this project's source code, feel free! It's pretty basic, most of the functionality lies inside of the `app/Http/Controllers/SendMessageController.php` class.

If you'd like to set this project up for yourself, follow these instructions:

**Step 1.** Gather your hardware.

You'll need:

- An Epson receipt printer (or another brand that can use ESC/POS formatting). You can find older models like the TM-T88IV on eBay for about $50 USD.

- Some piece of hardware running Linux with an open USB port. Performance-wise it just needs enough juice to power Docker, most Raspberry Pis should work well enough.

Get everything set up, powered on, and connected together.

**Step 2.** Clone this repo.

On your Linux hardware above, clone this repo into a place you'll be able to easily access and remember. Open up a terminal window into that location, and run the following command:

```sh
docker build -t ping-app:latest .
```

That will build the Docker image needed for the application, and then to run it, use the included `start.sh` script.

You should now be able to visit the site at `localhost:8000`!

**Step 3.** Open up public traffic (optional).

If you want to open up your own ping site to public traffic, you'll likely need to use a tunnelling service. I recommend either:

- [ngrok](https://ngrok.com)
- [cloudflare tunnels](https://developers.cloudflare.com/cloudflare-one/connections/connect-networks/)

Follow the documentation for either of them, installing the required daemons on your hardware and ensuring that the forwarded port is the same one exposed from the start.sh command above (e.g. `:8000`).
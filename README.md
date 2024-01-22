# Registration Module 1.1.2
## Module by Vertisan for Pterodactyl 1.11.5

Before proceeding with installation make sure you're running version 1.11.5 of Pterodactyl.

To install the module, you can go one way, either use the automatic installer or manually install the module.

### Automatic installer (RECOMMENDED)
1. Make sure you are in `/var/www/pterodactyl`
2. Install the installer via `composer require wemx/pterodactylregister`
3. Run `php artisan register:install`

### Manual installation
1. Upload all the folders into `/var/www/pterodactyl`
2. Go to `resources/scripts/components/auth/LoginContainer.tsx` and find `</LoginFormContainer>` in the file, before the line please put the following code below

    ```tsx
    <div css={tw`mt-6 text-center`}>
        <Link
            to={'/auth/register'}
            css={tw`text-xs text-neutral-500 tracking-wide no-underline uppercase`}
        >
            Don&apos;t have an account?
        </Link>
    </div>
    ```

3. Follow https://pterodactyl.io/community/customization/panel.html

**You're done! The button to the form can be found on your login page**

Need help? Join our Discord Server - https://discord.gg/RJfCxC2W3e
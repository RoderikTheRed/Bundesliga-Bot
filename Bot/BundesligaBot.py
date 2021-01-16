import time
import mysql.connector
import discord
import sys

class MyClient(discord.Client):
	async def on_ready(self):
		print("Ich habe mich erfolgreich angemeldet!")
	async def on_message(self, message):
		if message.author == client.user:
			return
		if message.content.startswith("!stop"):
			exit()
		if message.content.startswith("!table"):
			await message.channel.send("Table: ")
		
			await message.channel.send("| Rank | Society | Games | Points | Last 5")
			await message.channel.send("---------------------------------------------")
			try:
				connection = mysql.connector.connect(
								host = "45.156.85.215",
								user = "root",
								password = "Herbert12",
								database = "test"
								)
				mycursor = connection.cursor()
			except:
				print("Keine Verbindung zur Datenbank!")
				await message.channel.send("Keine Verbindung zur Datenbank!")

			sql = "SELECT * FROM tabelle ORDER BY `tabelle`.`RANG` ASC"

			mycursor.execute(sql)
			for dsatz in mycursor:
				satz = dsatz[0], dsatz[1], dsatz[2], dsatz[3]
				await message.channel.send("| " + str(dsatz[0]) + " | " + str(dsatz[1]) + " | " +  str(dsatz[2]) + " | " + str(dsatz[3]))
			connection.close()
		if message.content.startswith("!tabelle"):
			await message.add_reaction("🇦🇹")
			await message.channel.send("Tabelle: ")
		
			await message.channel.send("| Rang | Verein | Spiele | Punkte | Letzten 5")
			await message.channel.send("---------------------------------------------")
			try:
				connection = mysql.connector.connect(
								host = "localhost",
								user = "root",
								password = "",
								database = "test"
								)
				mycursor = connection.cursor()
			except:
				print("Keine Verbindung zur Datenbank!")
				await message.channel.send("Keine Verbindung zur Datenbank!")

			sql = "SELECT * FROM tabelle ORDER BY `tabelle`.`RANG` ASC"

			mycursor.execute(sql)
			for dsatz in mycursor:
				satz = dsatz[0], dsatz[1], dsatz[2], dsatz[3]
				await message.channel.send("| " + str(dsatz[0]) + " | " + str(dsatz[1]) + " | " +  str(dsatz[2]) + " | " + str(dsatz[3]))
			connection.close()
client = MyClient()
client.run("Nzk1NTQ1MDk5NDU0NTEzMjAz.X_K7HA.JqPALfkNf2J2UcgvgKye9GQHIzE")

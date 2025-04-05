import sys

print("Content-type: text/html\n")

items = [
    ("Cake", 20), ("Balloons", 21), ("Music System", 10), ("Lights", 5),
    ("Catering Service", 8), ("DJ", 3), ("Photo Booth", 15), ("Tables", 7),
    ("Chairs", 12), ("Drinks", 6), ("Party Hats", 9), ("Streamers", 18),
    ("Invitation Cards", 4), ("Party Games", 2), ("Cleaning Service", 11)
]

input_str = sys.stdin.read().strip()  

if not input_str:
    print("<h2>No input provided.</h2>")
    sys.exit()

try:
    indices = [int(i) for i in input_str.split(",")]
except:
    print("<h2>Invalid input.</h2>")
    sys.exit()

selected_items = []
selected_values = []
for i in indices:
    if 0 <= i < len(items):
        name, value = items[i]
        selected_items.append(name)
        selected_values.append(value)

if not selected_values:
    print("<h2>No valid selections.</h2>")
    sys.exit()

base_code = selected_values[0]
for val in selected_values[1:]:
    base_code &= val

adjusted_code = base_code
if base_code == 0:
    adjusted_code += 5
    message = "Epic Party Incoming!"
elif base_code > 5:
    adjusted_code -= 2
    message = "Let's keep it classy!"
else:
    message = "Chill vibes only!"

print("<html><body>")
print("<h2>Selected Items:</h2><ul>")
for item in selected_items:
    print(f"<li>{item}</li>")
print("</ul>")
print(f"<p><strong>Base Code:</strong> {base_code}</p>")
print(f"<p><strong>Final Code:</strong> {adjusted_code}</p>")
print(f"<p><strong>Message:</strong> {message}</p>")
print("</body></html>")

#!/usr/bin/env python3
"""
Vision Scout Chatbot
A simple chatbot for the Scout Shop
"""

def greet_user():
    """Greet the user when they start the chatbot"""
    print("🏕️ Welcome to Vision Scout Chatbot!")
    print("How can I help you today?")
    print("-" * 40)

def get_response(user_input):
    """Generate a response based on user input"""
    user_input = user_input.lower().strip()

    # Basic responses
    if "hello" in user_input or "hi" in user_input:
        return "Hello! How can I assist you with your scouting needs?"

    elif "products" in user_input or "shop" in user_input:
        return "We have T-Shirts ($12), Pants ($15), and Jackets ($25). Would you like to customize any?"

    elif "activities" in user_input:
        return "We offer indoor activities like knot-tying and first aid, and outdoor activities like camping and archery!"

    elif "contact" in user_input:
        return "You can reach us at troop@scouts.eg or call +20 1000121314"

    elif "bye" in user_input or "goodbye" in user_input:
        return "Goodbye! Happy scouting! 🏕️"

    else:
        return "I'm not sure about that. Can you ask about our products, activities, or contact info?"

def main():
    """Main chatbot loop"""
    greet_user()

    while True:
        try:
            user_input = input("You: ")
            if not user_input:
                continue

            response = get_response(user_input)
            print(f"Bot: {response}")

            # Exit condition
            if "bye" in user_input.lower() or "goodbye" in user_input.lower():
                break

        except KeyboardInterrupt:
            print("\nBot: Goodbye! Happy scouting! 🏕️")
            break
        except Exception as e:
            print(f"Bot: Sorry, something went wrong: {e}")

if __name__ == "__main__":
    main()
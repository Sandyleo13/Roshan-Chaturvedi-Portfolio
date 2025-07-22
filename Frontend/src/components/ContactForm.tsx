import { Button } from "@/components/ui/button";
import { X } from "lucide-react";
import { useState } from "react";

interface ContactFormProps {
  onClose: () => void;
}

const ContactForm: React.FC<ContactFormProps> = ({ onClose }) => {
  const [form, setForm] = useState({ name: "", email: "", message: "" });

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    console.log("Form data:", form);
    onClose();
  };

  return (
    <div className="fixed inset-0 bg-background/80 backdrop-blur flex items-center justify-center z-50">
      <div className="bg-card p-8 rounded-xl shadow-lg w-full max-w-xl relative">
        <button
          onClick={onClose}
          className="absolute top-4 right-4 text-muted-foreground hover:text-foreground"
        >
          <X size={20} />
        </button>
        <h2 className="text-2xl font-bold mb-4">Let’s Connect</h2>
        <p className="text-muted-foreground mb-6">
          I’d love to hear from you. Drop a message below 👇
        </p>
        <form onSubmit={handleSubmit} className="space-y-4">
          <input
            type="text"
            placeholder="Your Name"
            value={form.name}
            onChange={(e) => setForm({ ...form, name: e.target.value })}
            className="w-full p-3 border rounded hover:border-primary focus:outline-none"
            required
          />
          <input
            type="email"
            placeholder="Your Email"
            value={form.email}
            onChange={(e) => setForm({ ...form, email: e.target.value })}
            className="w-full p-3 border rounded hover:border-primary focus:outline-none"
            required
          />
          <textarea
            placeholder="Your Message"
            rows={4}
            value={form.message}
            onChange={(e) => setForm({ ...form, message: e.target.value })}
            className="w-full p-3 border rounded hover:border-primary focus:outline-none"
            required
          />
          <Button type="submit" className="w-full bg-gradient-primary hover-lift">
            Send Message
          </Button>
        </form>
      </div>
    </div>
  );
};

export default ContactForm;
